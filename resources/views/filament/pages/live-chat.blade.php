<x-filament-panels::page>
    <style>
        .chat-layout { display: flex; height: 75vh; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; background: #fff; }
        .chat-sidebar { width: 340px; border-right: 1px solid #e5e7eb; display: flex; flex-direction: column; background: #f9fafb; flex-shrink: 0; }
        .chat-sidebar-header { padding: 16px; border-bottom: 1px solid #e5e7eb; background: #fff; }
        .chat-sidebar-title { font-size: 1rem; font-weight: 600; color: #111827; }
        .chat-sidebar-subtitle { font-size: 0.75rem; color: #6b7280; margin-top: 2px; }
        .chat-filters { display: flex; gap: 4px; padding: 8px 16px; border-bottom: 1px solid #e5e7eb; background: #fff; }
        .chat-filter-btn { padding: 4px 12px; border-radius: 9999px; font-size: 0.7rem; font-weight: 500; border: 1px solid #e5e7eb; background: #fff; color: #6b7280; cursor: pointer; transition: all 0.15s; }
        .chat-filter-btn:hover { background: #f3f4f6; }
        .chat-filter-btn.active { background: #059669; color: #fff; border-color: #059669; }
        .chat-filter-count { display: inline-flex; align-items: center; justify-content: center; min-width: 18px; height: 18px; padding: 0 5px; border-radius: 9999px; font-size: 0.65rem; font-weight: 600; background: #e5e7eb; color: #374151; margin-left: 4px; }
        .chat-filter-btn.active .chat-filter-count { background: rgba(255,255,255,0.25); color: #fff; }
        .chat-sessions { flex: 1; overflow-y: auto; }
        .chat-session-item { padding: 12px 16px; border-bottom: 1px solid #f3f4f6; cursor: pointer; transition: background 0.15s; display: flex; gap: 12px; align-items: flex-start; }
        .chat-session-item:hover { background: #fff; }
        .chat-session-item.active { background: #fff; border-left: 3px solid #059669; }
        .chat-session-avatar { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.85rem; flex-shrink: 0; }
        .chat-session-avatar.guest { background: #f3f4f6; color: #6b7280; }
        .chat-session-avatar.user { background: #dbeafe; color: #1d4ed8; }
        .chat-session-info { flex: 1; min-width: 0; }
        .chat-session-name { font-size: 0.85rem; font-weight: 600; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .chat-session-preview { font-size: 0.75rem; color: #6b7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 2px; }
        .chat-session-meta { display: flex; flex-direction: column; align-items: flex-end; gap: 4px; flex-shrink: 0; }
        .chat-session-time { font-size: 0.65rem; color: #9ca3af; white-space: nowrap; }
        .chat-session-badge { display: inline-flex; align-items: center; justify-content: center; min-width: 18px; height: 18px; padding: 0 5px; border-radius: 9999px; font-size: 0.6rem; font-weight: 600; }
        .badge-live { background: #d1fae5; color: #065f46; }
        .badge-bot { background: #dbeafe; color: #1e40af; }
        .badge-closed { background: #f3f4f6; color: #6b7280; }
        .chat-session-agent { font-size: 0.65rem; color: #9ca3af; }
        .chat-main { flex: 1; display: flex; flex-direction: column; min-width: 0; }
        .chat-main-header { padding: 14px 20px; border-bottom: 1px solid #e5e7eb; background: #fff; display: flex; align-items: center; justify-content: space-between; }
        .chat-user-info { display: flex; align-items: center; gap: 12px; }
        .chat-user-avatar { width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 1rem; background: #dbeafe; color: #1d4ed8; }
        .chat-user-details h4 { font-size: 0.9rem; font-weight: 600; color: #111827; }
        .chat-user-details p { font-size: 0.75rem; color: #6b7280; }
        .chat-user-stats { display: flex; gap: 16px; margin-left: 24px; }
        .chat-user-stat { text-align: center; }
        .chat-user-stat-value { font-size: 1rem; font-weight: 700; color: #111827; }
        .chat-user-stat-label { font-size: 0.65rem; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; }
        .chat-header-actions { display: flex; gap: 8px; }
        .chat-action-btn { padding: 6px 14px; border-radius: 8px; font-size: 0.75rem; font-weight: 500; cursor: pointer; border: none; transition: all 0.15s; }
        .chat-action-close { background: #fef2f2; color: #dc2626; }
        .chat-action-close:hover { background: #fee2e2; }
        .chat-action-reopen { background: #f0fdf4; color: #16a34a; }
        .chat-action-reopen:hover { background: #dcfce7; }
        .chat-action-delete { background: #f9fafb; color: #6b7280; border: 1px solid #e5e7eb; }
        .chat-action-delete:hover { background: #f3f4f6; color: #dc2626; }
        .chat-messages-area { flex: 1; overflow-y: auto; padding: 20px; background: #f9fafb; display: flex; flex-direction: column; gap: 12px; }
        .chat-msg-row { display: flex; }
        .chat-msg-row.sent { justify-content: flex-end; }
        .chat-msg-row.received { justify-content: flex-start; }
        .chat-msg-bubble { max-width: 65%; padding: 10px 16px; border-radius: 16px; font-size: 0.85rem; line-height: 1.5; word-wrap: break-word; white-space: pre-wrap; }
        .chat-msg-bubble.admin { background: #059669; color: #fff; border-bottom-right-radius: 4px; }
        .chat-msg-bubble.admin .chat-msg-sender { color: rgba(255,255,255,0.7); }
        .chat-msg-bubble.user { background: #fff; color: #111827; border: 1px solid #e5e7eb; border-bottom-left-radius: 4px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .chat-msg-bubble.user .chat-msg-sender { color: #6b7280; }
        .chat-msg-bubble.bot { background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; border-bottom-left-radius: 4px; }
        .chat-msg-bubble.bot .chat-msg-sender { color: #3b82f6; }
        .chat-msg-sender { font-size: 0.65rem; font-weight: 600; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.03em; }
        .chat-msg-time { font-size: 0.6rem; margin-top: 4px; opacity: 0.6; }
        .chat-msg-bubble.admin .chat-msg-time { color: rgba(255,255,255,0.7); }
        .chat-msg-bubble.user .chat-msg-time { color: #9ca3af; }
        .chat-msg-bubble.bot .chat-msg-time { color: #93c5fd; }
        .chat-quick-replies { padding: 8px 20px; border-top: 1px solid #e5e7eb; background: #fff; display: flex; gap: 6px; flex-wrap: wrap; }
        .chat-quick-reply-btn { padding: 5px 12px; border-radius: 9999px; font-size: 0.7rem; font-weight: 500; background: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; cursor: pointer; transition: all 0.15s; white-space: nowrap; }
        .chat-quick-reply-btn:hover { background: #059669; color: #fff; border-color: #059669; }
        .chat-input-area { padding: 12px 20px; border-top: 1px solid #e5e7eb; background: #fff; display: flex; gap: 10px; align-items: center; }
        .chat-input { flex: 1; padding: 10px 16px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 0.85rem; outline: none; transition: border-color 0.15s; }
        .chat-input:focus { border-color: #059669; box-shadow: 0 0 0 3px rgba(5,150,105,0.1); }
        .chat-send-btn { padding: 10px 24px; background: #059669; color: #fff; border: none; border-radius: 10px; font-size: 0.85rem; font-weight: 500; cursor: pointer; transition: background 0.15s; }
        .chat-send-btn:hover { background: #047857; }
        .chat-send-btn:disabled { background: #d1d5db; cursor: not-allowed; }
        .chat-empty { flex: 1; display: flex; align-items: center; justify-content: center; color: #9ca3af; }
        .chat-empty-content { text-align: center; }
        .chat-empty-icon { width: 64px; height: 64px; margin: 0 auto 16px; color: #d1d5db; }
        .chat-date-divider { text-align: center; font-size: 0.7rem; color: #9ca3af; padding: 8px 0; }
        .chat-date-divider span { background: #f3f4f6; padding: 4px 12px; border-radius: 9999px; }
        .chat-system-msg { text-align: center; font-size: 0.75rem; color: #6b7280; padding: 8px 16px; background: #f3f4f6; border-radius: 8px; max-width: 80%; margin: 0 auto; }
    </style>

    <div class="chat-layout" wire:poll.5s="loadSessions">
        {{-- SIDEBAR --}}
        <div class="chat-sidebar">
            <div class="chat-sidebar-header">
                <div class="chat-sidebar-title">Conversations</div>
                <div class="chat-sidebar-subtitle">{{ count($sessions) }} total</div>
            </div>

            {{-- FILTER TABS --}}
            <div class="chat-filters">
                @php
                    $counts = \App\Models\ChatSession::selectRaw('status, count(*) as cnt')->groupBy('status')->pluck('cnt', 'status');
                @endphp
                <button wire:click="filterSessions('all')" class="chat-filter-btn {{ $statusFilter === 'all' ? 'active' : '' }}">
                    All<span class="chat-filter-count">{{ $counts->sum() }}</span>
                </button>
                <button wire:click="filterSessions('live')" class="chat-filter-btn {{ $statusFilter === 'live' ? 'active' : '' }}">
                    Live<span class="chat-filter-count">{{ $counts->get('live', 0) }}</span>
                </button>
                <button wire:click="filterSessions('bot')" class="chat-filter-btn {{ $statusFilter === 'bot' ? 'active' : '' }}">
                    Bot<span class="chat-filter-count">{{ $counts->get('bot', 0) }}</span>
                </button>
                <button wire:click="filterSessions('closed')" class="chat-filter-btn {{ $statusFilter === 'closed' ? 'active' : '' }}">
                    Closed<span class="chat-filter-count">{{ $counts->get('closed', 0) }}</span>
                </button>
            </div>

            {{-- SESSION LIST --}}
            <div class="chat-sessions">
                @forelse ($sessions as $session)
                    @php
                        $userName = $session['user']['name'] ?? 'Guest #' . $session['id'];
                        $userEmail = $session['user']['email'] ?? null;
                        $lastMsg = $session['last_message']['message'] ?? '';
                        $lastMsgPreview = Str::limit(strip_tags($lastMsg), 40);
                        $msgCount = $session['messages_count'] ?? 0;
                        $agentName = $session['assigned_admin']['name'] ?? null;
                        $isActive = $selectedSessionId == $session['id'];
                    @endphp
                    <div
                        wire:click="selectSession({{ $session['id'] }})"
                        class="chat-session-item {{ $isActive ? 'active' : '' }}"
                    >
                        <div class="chat-session-avatar {{ $userEmail ? 'user' : 'guest' }}">
                            {{ strtoupper(substr($userName, 0, 1)) }}
                        </div>
                        <div class="chat-session-info">
                            <div class="chat-session-name">{{ $userName }}</div>
                            @if($userEmail)
                                <div class="chat-session-preview" style="color:#6b7280;">{{ $userEmail }}</div>
                            @endif
                            @if($lastMsgPreview)
                                <div class="chat-session-preview">{{ $lastMsgPreview }}</div>
                            @endif
                        </div>
                        <div class="chat-session-meta">
                            <span class="chat-session-time">
                                {{ \Carbon\Carbon::parse($session['last_message_at'] ?? $session['created_at'])->diffForHumans() }}
                            </span>
                            <span class="chat-session-badge badge-{{ $session['status'] }}">
                                {{ ucfirst($session['status']) }}
                            </span>
                            @if($msgCount > 0)
                                <span class="chat-session-time">{{ $msgCount }} msgs</span>
                            @endif
                            @if($agentName)
                                <span class="chat-session-agent">-> {{ $agentName }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-400 text-sm">
                        No conversations found
                    </div>
                @endforelse
            </div>
        </div>

        {{-- MAIN CHAT AREA --}}
        <div class="chat-main">
            @if ($selectedSessionId && $selectedSession)
                @php
                    $user = $selectedSession['user'] ?? null;
                    $userName = $user['name'] ?? 'Guest #' . $selectedSession['id'];
                    $userEmail = $user['email'] ?? 'N/A';
                    $memberSince = $user ? \Carbon\Carbon::parse($user['created_at'])->format('M d, Y') : 'N/A';
                    $orderCount = $user ? \App\Models\Order::where('user_id', $user['id'])->count() : 0;
                    $agentName = $selectedSession['assigned_admin']['name'] ?? 'Unassigned';
                    $sessionStatus = $selectedSession['status'];
                    $sessionDate = \Carbon\Carbon::parse($selectedSession['created_at'])->format('M d, Y h:i A');
                @endphp

                {{-- HEADER --}}
                <div class="chat-main-header">
                    <div class="chat-user-info">
                        <div class="chat-user-avatar">{{ strtoupper(substr($userName, 0, 1)) }}</div>
                        <div class="chat-user-details">
                            <h4>{{ $userName }}</h4>
                            <p>{{ $userEmail }}</p>
                        </div>
                        <div class="chat-user-stats">
                            <div class="chat-user-stat">
                                <div class="chat-user-stat-value">{{ $orderCount }}</div>
                                <div class="chat-user-stat-label">Orders</div>
                            </div>
                            <div class="chat-user-stat">
                                <div class="chat-user-stat-value">{{ count($messages) }}</div>
                                <div class="chat-user-stat-label">Messages</div>
                            </div>
                            <div class="chat-user-stat">
                                <div class="chat-user-stat-value" style="font-size:0.75rem;">{{ $memberSince }}</div>
                                <div class="chat-user-stat-label">Member Since</div>
                            </div>
                            <div class="chat-user-stat">
                                <div class="chat-user-stat-value" style="font-size:0.75rem;">{{ $agentName }}</div>
                                <div class="chat-user-stat-label">Assigned To</div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-header-actions">
                        @if($sessionStatus === 'closed')
                            <button wire:click="reopenSession" class="chat-action-btn chat-action-reopen">Reopen</button>
                        @else
                            <button wire:click="closeSession" class="chat-action-btn chat-action-close">Close Chat</button>
                        @endif
                        <button wire:click="deleteSession({{ $selectedSessionId }})" wire:confirm="Delete this conversation permanently?" class="chat-action-btn chat-action-delete">Delete</button>
                    </div>
                </div>

                {{-- MESSAGES --}}
                <div class="chat-messages-area" id="chat-messages" wire:poll.3s="loadMessages">
                    @php $lastDate = null; @endphp
                    @forelse ($messages as $message)
                        @php
                            $msgDate = \Carbon\Carbon::parse($message['created_at'])->format('M d, Y');
                            $msgTime = \Carbon\Carbon::parse($message['created_at'])->format('h:i A');
                            $senderType = $message['sender_type'];
                            $isMe = $senderType === 'admin';
                            $isBot = $senderType === 'bot';
                            $senderName = $isMe ? 'Admin' : ($isBot ? 'Bot' : $userName);
                        @endphp

                        @if($msgDate !== $lastDate)
                            <div class="chat-date-divider"><span>{{ $msgDate }}</span></div>
                            @php $lastDate = $msgDate; @endphp
                        @endif

                        @if($isBot && str_contains($message['message'], 'connected you with our support'))
                            <div class="chat-system-msg">{!! nl2br(e($message['message'])) !!}</div>
                        @else
                            <div class="chat-msg-row {{ $isMe ? 'sent' : 'received' }}">
                                <div class="chat-msg-bubble {{ $senderType }}">
                                    <div class="chat-msg-sender">{{ $senderName }}</div>
                                    <div>{!! nl2br(e($message['message'])) !!}</div>
                                    <div class="chat-msg-time">{{ $msgTime }}</div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center text-gray-400 text-sm py-8">No messages yet</div>
                    @endforelse
                </div>

                {{-- QUICK REPLIES --}}
                @if($sessionStatus !== 'closed')
                    <div class="chat-quick-replies">
                        @foreach($quickReplies as $reply)
                            <button wire:click="sendQuickReply('{{ addslashes($reply) }}')" class="chat-quick-reply-btn">{{ $reply }}</button>
                        @endforeach
                    </div>

                    {{-- INPUT --}}
                    <div class="chat-input-area">
                        <form wire:submit="sendMessage" class="chat-input-area" style="border:none;padding:0;width:100%;display:flex;gap:10px;">
                            <input
                                type="text"
                                wire:model="newMessage"
                                placeholder="Type your reply..."
                                class="chat-input"
                            >
                            <button type="submit" class="chat-send-btn" {{ empty(trim($newMessage)) ? 'disabled' : '' }}>Send</button>
                        </form>
                    </div>
                @else
                    <div class="chat-input-area" style="justify-content:center;color:#9ca3af;font-size:0.85rem;">
                        This conversation is closed.
                    </div>
                @endif
            @else
                <div class="chat-empty">
                    <div class="chat-empty-content">
                        <svg class="chat-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <p style="font-size:1.1rem;font-weight:600;color:#374151;">Select a conversation</p>
                        <p style="font-size:0.85rem;margin-top:4px;">Choose a chat from the sidebar to start responding</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.hook('morph.updated', ({ el }) => {
                const container = document.getElementById('chat-messages');
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        });
    </script>
</x-filament-panels::page>
