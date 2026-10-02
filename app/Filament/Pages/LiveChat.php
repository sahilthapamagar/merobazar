<?php

namespace App\Filament\Pages;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class LiveChat extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeftRight;
    protected static ?string $navigationLabel = 'Live Chat';
    protected static ?string $title = 'Live Chat Support';
    protected string $view = 'filament.pages.live-chat';

    public ?array $data = [];
    public $selectedSessionId = null;
    public $messages = [];
    public $sessions = [];
    public $newMessage = '';
    public $statusFilter = 'all';
    public $selectedSession = null;

    public array $quickReplies = [
        'Thanks for contacting us! How can I help you today?',
        'Your order is on the way! You will receive it soon.',
        'Please check your email for further instructions.',
        'We apologize for the inconvenience. Let me look into this for you.',
        'Your refund has been processed. It will reflect in 5-7 business days.',
        'Is there anything else I can help you with?',
        'Thank you for your patience! Have a great day.',
    ];

    public function mount(): void
    {
        $this->loadSessions();
    }

    public function loadSessions(): void
    {
        $query = ChatSession::with(['user', 'assignedAdmin', 'lastMessage'])
            ->withCount('messages');

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        $this->sessions = $query->orderByRaw('ISNULL(last_message_at), last_message_at DESC')
            ->get()
            ->toArray();
    }

    public function filterSessions(string $filter): void
    {
        $this->statusFilter = $filter;
        $this->loadSessions();
    }

    public function selectSession($sessionId): void
    {
        $this->selectedSessionId = $sessionId;

        $session = ChatSession::find($sessionId);
        if ($session) {
            $session->update(['assigned_to' => Auth::guard('admin')->id()]);
            $this->selectedSession = $session->load(['user', 'assignedAdmin'])->toArray();
        }

        $this->loadMessages();
    }

    public function loadMessages(): void
    {
        if (!$this->selectedSessionId) return;

        $this->messages = ChatMessage::where('chat_session_id', $this->selectedSessionId)
            ->orderBy('id')
            ->get()
            ->toArray();
    }

    public function sendMessage(): void
    {
        if (!$this->selectedSessionId || empty(trim($this->newMessage))) return;

        ChatMessage::create([
            'chat_session_id' => $this->selectedSessionId,
            'sender_type' => 'admin',
            'sender_id' => Auth::guard('admin')->id(),
            'message' => $this->newMessage,
        ]);

        ChatSession::where('id', $this->selectedSessionId)
            ->update(['last_message_at' => now()]);

        $this->newMessage = '';
        $this->loadMessages();
        $this->loadSessions();
    }

    public function sendQuickReply(string $reply): void
    {
        if (!$this->selectedSessionId) return;

        ChatMessage::create([
            'chat_session_id' => $this->selectedSessionId,
            'sender_type' => 'admin',
            'sender_id' => Auth::guard('admin')->id(),
            'message' => $reply,
        ]);

        ChatSession::where('id', $this->selectedSessionId)
            ->update(['last_message_at' => now()]);

        $this->loadMessages();
        $this->loadSessions();
    }

    public function closeSession(): void
    {
        if (!$this->selectedSessionId) return;

        ChatSession::where('id', $this->selectedSessionId)->update(['status' => 'closed']);
        $this->selectedSessionId = null;
        $this->selectedSession = null;
        $this->messages = [];
        $this->loadSessions();
    }

    public function reopenSession(): void
    {
        if (!$this->selectedSessionId) return;

        ChatSession::where('id', $this->selectedSessionId)->update(['status' => 'live']);
        $this->loadSessions();

        if ($this->selectedSessionId) {
            $this->selectedSession = ChatSession::with(['user', 'assignedAdmin'])
                ->find($this->selectedSessionId)
                ?->toArray();
        }
    }

    public function deleteSession($sessionId): void
    {
        ChatMessage::where('chat_session_id', $sessionId)->delete();
        ChatSession::where('id', $sessionId)->delete();

        if ($this->selectedSessionId == $sessionId) {
            $this->selectedSessionId = null;
            $this->selectedSession = null;
            $this->messages = [];
        }

        $this->loadSessions();
    }

    public function getFormSchema(): array
    {
        return [];
    }
}
