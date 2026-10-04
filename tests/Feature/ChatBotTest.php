<?php

use App\Models\Category;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use App\Models\Order;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use App\Services\ChatBotService;

function makeCategory(string $name = 'Footwear', string $slug = 'footwear'): Category
{
    return Category::create(['name' => $name, 'slug' => $slug]);
}

function makeProduct(Category $category, string $name = 'Running Shoes'): Product
{
    $seller = Seller::factory()->create();

    return Product::create([
        'name' => $name,
        'title' => $name,
        'description' => 'A great product.',
        'price' => 2000,
        'main_image' => 'products/shoes.jpg',
        'seller_id' => $seller->id,
        'category_id' => $category->id,
    ]);
}

beforeEach(function () {
    $this->bot = app(ChatBotService::class);
});

it('greets a visitor who says hello', function () {
    $result = $this->bot->reply('Hello there!');

    expect($result['reply'])->toContain('Welcome to MeroBazar')
        ->and($result['escalate'])->toBeFalse();
});

it('does not treat an order question as a plain greeting', function () {
    $result = $this->bot->reply('hi, where is my order?');

    expect($result['reply'])->toContain('log in');
});

it('answers shipping questions', function () {
    expect($this->bot->reply('How long does shipping take?')['reply'])
        ->toContain('Shipping Information');
});

it('answers returns and refund questions', function () {
    expect($this->bot->reply('I want a refund please')['reply'])
        ->toContain('Returns & Refunds');
});

it('matches the category intent instead of the product intent', function () {
    $category = makeCategory();
    makeProduct($category);

    $result = $this->bot->reply('show me your categories');

    expect($result['reply'])->toContain('Our Categories');
});

it('shows products from a named category', function () {
    $category = makeCategory('Headphones', 'headphones');
    makeProduct($category, 'Studio Headphones');

    $result = $this->bot->reply('what headphones do you have?');

    expect($result['reply'])->toContain('Headphones');
});

it('searches products by name', function () {
    $category = makeCategory();
    makeProduct($category, 'Leather Jacket');

    $result = $this->bot->reply("i'm looking for a leather jacket");

    expect($result['reply'])->toContain('Leather Jacket');
});

it('flags an escalation when a human is requested', function () {
    foreach (['human', 'talk to an agent', 'I need a real person'] as $message) {
        $result = $this->bot->reply($message);

        expect($result['escalate'])->toBeTrue()
            ->and($result['reply'])->toContain('support team');
    }
});

it('asks a guest to log in before tracking an order', function () {
    expect($this->bot->reply('track my order')['reply'])
        ->toContain('log in');
});

it('reports the latest order for an authenticated user', function () {
    $user = User::factory()->create();
    $seller = Seller::factory()->create();

    $order = Order::create([
        'user_id' => $user->id,
        'seller_id' => $seller->id,
        'status' => 'processing',
        'total_amount' => 2000,
        'payment_method' => 'cod',
        'payment_status' => 'pending',
    ]);

    $this->actingAs($user);

    expect($this->bot->reply('where is my order')['reply'])
        ->toContain("Order #{$order->id}")
        ->toContain('Processing');
});

it('falls back gracefully for an unrecognised message', function () {
    expect($this->bot->reply('zxcvbnm')['reply'])
        ->toContain("I'm not sure I understand");
});

it('escalates and flips the session live when a user asks for a human', function () {
    $user = User::factory()->create();
    $session = ChatSession::create(['user_id' => $user->id, 'status' => 'bot', 'last_message_at' => now()]);

    $response = $this->actingAs($user)->postJson('/chat/message', [
        'chat_session_id' => $session->id,
        'message' => 'I want to talk to a human',
    ]);

    $response->assertOk()
        ->assertJson(['escalated' => true, 'status' => 'live']);

    expect($session->fresh()->status)->toBe('live')
        ->and(ChatMessage::where('chat_session_id', $session->id)->where('sender_type', 'bot')->count())->toBe(1);
});

it('forbids reading a chat session owned by another user', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();
    $session = ChatSession::create(['user_id' => $owner->id, 'status' => 'bot', 'last_message_at' => now()]);

    $this->actingAs($other)
        ->getJson("/chat/messages/{$session->id}")
        ->assertForbidden();
});

it('returns messages and status for the owning user', function () {
    $owner = User::factory()->create();
    $session = ChatSession::create(['user_id' => $owner->id, 'status' => 'bot', 'last_message_at' => now()]);

    ChatMessage::create([
        'chat_session_id' => $session->id,
        'sender_type' => 'bot',
        'message' => 'Hello!',
    ]);

    $this->actingAs($owner)
        ->getJson("/chat/messages/{$session->id}")
        ->assertOk()
        ->assertJsonPath('status', 'bot')
        ->assertJsonCount(1, 'messages');
});
