<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function startSession(): JsonResponse
    {
        $user = Auth::guard('web')->user();

        $session = ChatSession::create([
            'user_id' => $user?->id,
            'status' => 'bot',
            'last_message_at' => now(),
        ]);

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender_type' => 'bot',
            'message' => "Hi there! I'm MeroBazar's virtual assistant. How can I help you today?\n\nYou can ask me about:\n- Shipping & delivery\n- Returns & refunds\n- Order tracking\n- Products & categories\n\nOr type **'human'** to talk to a live agent.",
        ]);

        return response()->json(['session_id' => $session->id]);
    }

    public function sendMessage(Request $request): JsonResponse
    {
        $request->validate([
            'chat_session_id' => 'required|exists:chat_sessions,id',
            'message' => 'required|string|max:1000',
        ]);

        $session = ChatSession::findOrFail($request->chat_session_id);

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender_type' => 'user',
            'sender_id' => Auth::guard('web')->id(),
            'message' => $request->message,
        ]);

        $session->update(['last_message_at' => now()]);

        if ($session->status === 'live') {
            return response()->json([
                'reply' => 'Your message has been sent to our support team. Please wait for a response.',
                'sender_type' => 'bot',
            ]);
        }

        $reply = $this->generateBotReply($request->message, $session);

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender_type' => 'bot',
            'message' => $reply,
        ]);

        $session->update(['last_message_at' => now()]);

        return response()->json([
            'reply' => $reply,
            'sender_type' => 'bot',
        ]);
    }

    public function escalateToHuman(Request $request): JsonResponse
    {
        $request->validate([
            'chat_session_id' => 'required|exists:chat_sessions,id',
        ]);

        $session = ChatSession::findOrFail($request->chat_session_id);
        $session->update(['status' => 'live', 'last_message_at' => now()]);

        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender_type' => 'bot',
            'message' => "I've connected you with our support team. An agent will respond shortly. You can continue typing your message below.",
        ]);

        $session->update(['last_message_at' => now()]);

        return response()->json(['status' => 'live']);
    }

    public function getMessages(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'after' => 'nullable|integer',
        ]);

        $query = ChatMessage::where('chat_session_id', $id);

        if ($request->after) {
            $query->where('id', '>', $request->after);
        }

        $messages = $query->orderBy('id')->get();

        return response()->json($messages);
    }

    private function generateBotReply(string $message, ChatSession $session): string
    {
        $lower = strtolower(trim($message));

        if (in_array($lower, ['human', 'talk to human', 'agent', 'support', 'real person'])) {
            return "Sure! Let me connect you with a live agent. Please wait a moment...";
        }

        if (preg_match('/\b(hi|hello|hey|good\s*(morning|afternoon|evening)|namaste|sup)\b/', $lower)) {
            return "Hello! Welcome to MeroBazar. How can I assist you today?";
        }

        if (preg_match('/\b(shipping|delivery|deliver|ship)\b/', $lower)) {
            return "📦 **Shipping Information**\n\n- Free shipping on orders over Rs. 1500\n- Standard delivery: 3-5 business days\n- Express delivery: 1-2 business days\n- We ship across Nepal\n\nNeed more details? Ask me anything!";
        }

        if (preg_match('/\b(return|refund|exchange|replace)\b/', $lower)) {
            return "🔄 **Returns & Refunds**\n\n- 7-day return policy from delivery date\n- Items must be unused with tags attached\n- Refund processed within 5-7 business days\n- Free returns for defective items\n\nWould you like to initiate a return?";
        }

        if (preg_match('/\b(track|order|status|where)\b/', $lower)) {
            $user = Auth::guard('web')->user();
            if ($user) {
                $order = Order::where('user_id', $user->id)->latest()->first();
                if ($order) {
                    return "📋 **Your Latest Order**\n\nOrder #" . $order->id . "\nStatus: " . ucfirst($order->status) . "\n\nVisit your [Buying History](/buying-history) for full details.";
                }
                return "You don't have any orders yet. Browse our [products](/products) to get started!";
            }
            return "Please log in to check your order status. You can log in from the top-right corner of the page.";
        }

        if (preg_match('/\b(product|products|shop|browse|category|categories|buy)\b/', $lower)) {
            $products = Product::latest()->take(3)->get(['id', 'name', 'discounted_price']);
            if ($products->isEmpty()) {
                return "Check out our latest products at [Products](/products)! We have a wide range of categories to choose from.";
            }
            $list = $products->map(function ($p) {
                return "- {$p->name} — Rs. " . number_format($p->discounted_price);
            })->join("\n");
            return "🛍️ **Popular Products**\n\n{$list}\n\nVisit [Products](/products) to see all items!";
        }

        if (preg_match('/\b(category|categories)\b/', $lower)) {
            $categories = \App\Models\Category::take(5)->get(['id', 'name', 'slug']);
            if ($categories->isEmpty()) {
                return "We have many categories! Visit [Categories](/categories) to explore.";
            }
            $list = $categories->map(fn($c) => "- [{$c->name}](/products?category={$c->slug})")->join("\n");
            return "📂 **Our Categories**\n\n{$list}\n\nSee all at [Categories](/categories)!";
        }

        if (preg_match('/\b(price|cost|cheap|discount|sale|offer)\b/', $lower)) {
            return "💰 **Pricing & Offers**\n\n- We offer competitive prices on all products\n- Free shipping on orders over Rs. 1500\n- Check our [Products](/products) page for current deals\n\nLooking for a specific item?";
        }

        if (preg_match('/\b(payment|pay|khalti|esewa|cod)\b/', $lower)) {
            return "💳 **Payment Methods**\n\n- Khalti (online)\n- Cash on Delivery (COD)\n\nAll transactions are secure and encrypted.";
        }

        if (preg_match('/\b(sell|vendor|seller|become)\b/', $lower)) {
            return "🏪 **Sell on MeroBazar**\n\nInterested in becoming a seller? Fill out our [Vendor Application](/seller-form) and our team will review your request within 48 hours.";
        }

        if (preg_match('/\b(contact|phone|email|address|reach)\b/', $lower)) {
            return "📞 **Contact Us**\n\n- Email: support@merobazar.com\n- Phone: +977-XXXXXXXXXX\n- Address: Kathmandu, Nepal\n\nOr use this chat to reach us anytime!";
        }

        if (preg_match('/\b(thank|thanks|dhanyabad|shukriya)\b/', $lower)) {
            return "You're welcome! Is there anything else I can help you with?";
        }

        if (preg_match('/\b(bye|goodbye|see\s*you|alvida|huss)\b/', $lower)) {
            return "Goodbye! Have a great day! Feel free to come back anytime. 😊";
        }

        return "I'm not sure I understand that. Could you try rephrasing?\n\nI can help with:\n- Shipping & delivery\n- Returns & refunds\n- Order tracking\n- Products & categories\n- Payment methods\n\nOr type **'human'** to talk to a live agent.";
    }
}
