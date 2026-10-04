<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use App\Services\ChatBotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(private readonly ChatBotService $bot) {}

    public function startSession(Request $request): JsonResponse
    {
        $user = Auth::guard('web')->user();

        $session = ChatSession::create([
            'user_id' => $user?->id,
            'status' => 'bot',
            'last_message_at' => now(),
        ]);

        // Remember guest-owned sessions so they can be re-opened safely without
        // trusting a client-supplied id alone.
        $request->session()->push('chat.sessions', $session->id);

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender_type' => 'bot',
            'message' => $this->bot->welcomeMessage(),
        ]);

        return response()->json([
            'session_id' => $session->id,
            'status' => $session->status,
        ]);
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'chat_session_id' => 'required|integer|exists:chat_sessions,id',
            'message' => 'required|string|max:1000',
        ]);

        $session = $this->authorizedSession($request, (int) $request->chat_session_id);

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender_type' => 'user',
            'sender_id' => Auth::guard('web')->id(),
            'message' => $request->message,
        ]);

        if ($session->status === 'live') {
            $session->update(['last_message_at' => now()]);

            return response()->json([
                'reply' => null,
                'sender_type' => 'bot',
                'status' => 'live',
                'escalated' => false,
            ]);
        }

        $result = $this->bot->reply($request->message, $session);

        if ($result['escalate']) {
            $session->status = 'live';
        }

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender_type' => 'bot',
            'message' => $result['reply'],
        ]);

        $session->update(['last_message_at' => now()]);

        return response()->json([
            'reply' => $result['reply'],
            'sender_type' => 'bot',
            'status' => $session->status,
            'escalated' => $result['escalate'],
        ]);
    }

    public function escalateToHuman(Request $request): JsonResponse
    {
        $request->validate([
            'chat_session_id' => 'required|integer|exists:chat_sessions,id',
        ]);

        $session = $this->authorizedSession($request, (int) $request->chat_session_id);

        if ($session->status !== 'live') {
            $session->update(['status' => 'live', 'last_message_at' => now()]);

            ChatMessage::create([
                'chat_session_id' => $session->id,
                'sender_type' => 'bot',
                'message' => $this->bot->handoffMessage(),
            ]);
        }

        return response()->json(['status' => 'live']);
    }

    public function getMessages(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'after' => 'nullable|integer',
        ]);

        $session = $this->authorizedSession($request, (int) $id);

        $query = ChatMessage::where('chat_session_id', $session->id);

        if ($request->filled('after')) {
            $query->where('id', '>', $request->integer('after'));
        }

        return response()->json([
            'status' => $session->status,
            'messages' => $query->orderBy('id')->get(),
        ]);
    }

    /**
     * Resolve a chat session and ensure the requester is allowed to use it.
     *
     * A session is accessible when it belongs to the authenticated user or the
     * requester created it in their current Laravel session (guest chat).
     */
    private function authorizedSession(Request $request, int $id): ChatSession
    {
        $session = ChatSession::find($id);

        abort_if($session === null, 404, 'Chat session not found.');

        $userId = Auth::guard('web')->id();
        $ownedByUser = $session->user_id !== null && $userId !== null && (int) $session->user_id === (int) $userId;
        $ownedByGuest = in_array($session->id, (array) $request->session()->get('chat.sessions', []), true);

        abort_unless($ownedByUser || $ownedByGuest, 403, 'This chat session does not belong to you.');

        return $session;
    }
}
