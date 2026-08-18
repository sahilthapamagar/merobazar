<style>
    /* ─── CHAT WIDGET ─── */
    .chat-widget {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 9990;
        font-family: 'DM Sans', sans-serif;
    }

    .chat-toggle-btn {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--primary);
        color: var(--accent);
        border: none;
        cursor: none;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(43, 31, 20, 0.25);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .chat-toggle-btn:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 28px rgba(43, 31, 20, 0.35);
    }

    .chat-toggle-btn svg {
        width: 24px;
        height: 24px;
    }

    .chat-panel {
        position: absolute;
        bottom: 72px;
        right: 0;
        width: 380px;
        height: 520px;
        background: var(--cream);
        border: 1px solid rgba(171, 136, 109, 0.25);
        border-radius: 16px;
        box-shadow: 0 16px 48px rgba(43, 31, 20, 0.18);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transform-origin: bottom right;
        transition: opacity 0.25s, transform 0.25s;
    }

    .chat-panel.hidden {
        opacity: 0;
        transform: scale(0.92) translateY(12px);
        pointer-events: none;
    }

    .chat-header {
        background: var(--primary);
        color: var(--accent);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-shrink: 0;
    }

    .chat-header-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chat-header-avatar {
        width: 36px;
        height: 36px;
        background: var(--secondary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem;
        font-weight: 600;
    }

    .chat-header-title {
        font-size: 0.85rem;
        font-weight: 500;
    }

    .chat-header-status {
        font-size: 0.68rem;
        color: rgba(214, 192, 179, 0.7);
        margin-top: 2px;
    }

    .chat-close-btn {
        background: none;
        border: none;
        color: var(--accent);
        cursor: none;
        padding: 4px;
        display: flex;
        opacity: 0.7;
        transition: opacity 0.2s;
    }

    .chat-close-btn:hover {
        opacity: 1;
    }

    .chat-close-btn svg {
        width: 18px;
        height: 18px;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .chat-messages::-webkit-scrollbar {
        width: 3px;
    }

    .chat-messages::-webkit-scrollbar-thumb {
        background: var(--secondary);
        border-radius: 3px;
    }

    .chat-msg {
        max-width: 80%;
        padding: 10px 14px;
        border-radius: 14px;
        font-size: 0.8rem;
        line-height: 1.55;
        word-wrap: break-word;
        white-space: pre-wrap;
    }

    .chat-msg.bot,
    .chat-msg.admin {
        align-self: flex-start;
        background: var(--primary);
        color: var(--accent);
        border-bottom-left-radius: 4px;
    }

    .chat-msg.user {
        align-self: flex-end;
        background: var(--secondary);
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .chat-msg a {
        color: var(--accent);
        text-decoration: underline;
    }

    .chat-msg.user a {
        color: #fff;
    }

    .chat-typing {
        align-self: flex-start;
        padding: 10px 14px;
        background: var(--primary);
        color: var(--accent);
        border-radius: 14px;
        border-bottom-left-radius: 4px;
        font-size: 0.75rem;
        display: flex;
        gap: 4px;
        align-items: center;
    }

    .chat-typing span {
        width: 5px;
        height: 5px;
        background: var(--accent);
        border-radius: 50%;
        animation: chatBounce 1.2s infinite;
    }

    .chat-typing span:nth-child(2) { animation-delay: 0.15s; }
    .chat-typing span:nth-child(3) { animation-delay: 0.3s; }

    @keyframes chatBounce {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-4px); }
    }

    .chat-escalate-btn {
        display: block;
        margin: 4px auto 8px;
        padding: 6px 14px;
        background: var(--secondary);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 500;
        letter-spacing: 0.04em;
        cursor: none;
        transition: background 0.2s;
    }

    .chat-escalate-btn:hover {
        background: var(--primary);
    }

    .chat-input-area {
        padding: 12px 16px;
        border-top: 1px solid rgba(171, 136, 109, 0.18);
        display: flex;
        gap: 8px;
        align-items: center;
        background: var(--cream);
        flex-shrink: 0;
    }

    .chat-input {
        flex: 1;
        border: 1px solid rgba(171, 136, 109, 0.3);
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.8rem;
        font-family: 'DM Sans', sans-serif;
        color: var(--primary);
        background: #fff;
        outline: none;
        transition: border-color 0.2s;
    }

    .chat-input:focus {
        border-color: var(--secondary);
    }

    .chat-send-btn {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: var(--primary);
        color: var(--accent);
        border: none;
        cursor: none;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: background 0.2s;
    }

    .chat-send-btn:hover {
        background: var(--secondary);
    }

    .chat-send-btn svg {
        width: 16px;
        height: 16px;
    }

    @media (max-width: 480px) {
        .chat-widget {
            bottom: 16px;
            right: 16px;
        }

        .chat-panel {
            width: calc(100vw - 32px);
            height: calc(100vh - 120px);
            bottom: 68px;
            right: -8px;
            border-radius: 12px;
        }
    }
</style>

<div class="chat-widget" x-data="chatWidget()" x-cloak>
    <!-- Chat Panel -->
    <div class="chat-panel" :class="{ 'hidden': !open }">
        <div class="chat-header">
            <div class="chat-header-info">
                <div class="chat-header-avatar">M</div>
                <div>
                    <div class="chat-header-title">MeroBazar Support</div>
                    <div class="chat-header-status" x-text="status === 'live' ? 'Agent online' : 'Virtual assistant'"></div>
                </div>
            </div>
            <button class="chat-close-btn" @click="open = false" aria-label="Close chat">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="chat-messages" x-ref="messagesContainer" @scroll="handleScroll">
            <template x-for="(msg, index) in messages" :key="msg.id">
                <div>
                    <div class="chat-msg" :class="msg.sender_type" x-html="formatMessage(msg.message)"></div>
                    <template x-if="msg.sender_type === 'bot' && !escalated && status !== 'live' && index === messages.length - 1">
                        <button class="chat-escalate-btn" @click="escalateToHuman()">Talk to a Human</button>
                    </template>
                </div>
            </template>
            <div class="chat-typing" x-show="typing">
                <span></span><span></span><span></span>
            </div>
            <div class="chat-msg error" x-show="errorMsg" x-text="errorMsg" style="background:#9a4a4a;color:#fff;align-self:center;text-align:center;max-width:90%;"></div>
        </div>

        <div class="chat-input-area">
            <input
                type="text"
                class="chat-input"
                placeholder="Type your message..."
                x-model="newMessage"
                @keydown.enter.prevent="sendMessage()"
                :disabled="typing"
            >
            <button class="chat-send-btn" @click="sendMessage()" :disabled="typing || !newMessage.trim()" aria-label="Send message">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M22 2L11 13M22 2l-7 20-4-9-9-4z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Toggle Button -->
    <button class="chat-toggle-btn" @click="toggleChat()" aria-label="Open chat">
        <svg x-show="!open" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
        </svg>
        <svg x-show="open" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M18 6L6 18M6 6l12 12"/>
        </svg>
    </button>
</div>

<script>
function chatWidget() {
    return {
        open: false,
        messages: [],
        newMessage: '',
        typing: false,
        sessionId: null,
        status: 'bot',
        escalated: false,
        errorMsg: '',
        lastMessageId: 0,
        pollInterval: null,

        async toggleChat() {
            this.open = !this.open;
            if (this.open && !this.sessionId) {
                await this.startSession();
            }
            if (this.open) {
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        async startSession() {
            try {
                const res = await fetch('/chat/session', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                });
                const data = await res.json();
                this.sessionId = data.session_id;
                await this.loadMessages();
                this.startPolling();
            } catch (e) {
                console.error('Failed to start chat session', e);
                this.errorMsg = 'Failed to connect. Please refresh the page.';
            }
        },

        async loadMessages() {
            if (!this.sessionId) return;
            try {
                const url = this.lastMessageId
                    ? `/chat/messages/${this.sessionId}?after=${this.lastMessageId}`
                    : `/chat/messages/${this.sessionId}`;
                const res = await fetch(url, {
                    headers: { 'Accept': 'application/json' },
                });
                const data = await res.json();
                if (data.length) {
                    this.messages.push(...data);
                    this.lastMessageId = data[data.length - 1].id;
                    this.$nextTick(() => this.scrollToBottom());
                }
            } catch (e) {
                console.error('Failed to load messages', e);
            }
        },

        startPolling() {
            if (this.pollInterval) return;
            this.pollInterval = setInterval(async () => {
                if (this.open) {
                    await this.loadMessages();
                }
            }, 3000);
        },

        async sendMessage() {
            const text = this.newMessage.trim();
            if (!text || !this.sessionId) return;

            this.newMessage = '';
            this.typing = true;
            this.errorMsg = '';

            try {
                const res = await fetch('/chat/message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        chat_session_id: this.sessionId,
                        message: text,
                    }),
                });
                const data = await res.json();
                await this.loadMessages();

                if (data.sender_type === 'bot' && text.toLowerCase().includes('human')) {
                    await this.escalateToHuman();
                }
            } catch (e) {
                console.error('Failed to send message', e);
                this.errorMsg = 'Failed to send. Please try again.';
                this.$nextTick(() => this.scrollToBottom());
            } finally {
                this.typing = false;
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        async escalateToHuman() {
            if (!this.sessionId) return;
            try {
                await fetch('/chat/escalate', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        chat_session_id: this.sessionId,
                    }),
                });
                this.status = 'live';
                this.escalated = true;
                await this.loadMessages();
            } catch (e) {
                console.error('Failed to escalate', e);
            }
        },

        scrollToBottom() {
            const container = this.$refs.messagesContainer;
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        },

        handleScroll() {
        },

        formatMessage(text) {
            text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            text = text.replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank">$1</a>');
            return text;
        },

        destroy() {
            if (this.pollInterval) {
                clearInterval(this.pollInterval);
            }
        },
    };
}
</script>
