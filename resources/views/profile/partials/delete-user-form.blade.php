<section class="space-y-6">
    <h2 class="profile-card-heading">Delete Account</h2>
    <p class="profile-card-desc">
        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
    </p>

    <button type="button" class="profile-btn profile-btn--danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        Delete Account
    </button>

    {{-- Delete Confirmation Modal --}}
    <div x-data="{ show: false }"
        x-init="$watch('show', value => document.body.classList.toggle('overflow-hidden', value))"
        x-on:open-modal.window="$event.detail == 'confirm-user-deletion' ? show = true : null"
        x-on:close-modal.window="$event.detail == 'confirm-user-deletion' ? show = false : null"
        x-on:keydown.escape.window="show = false"
        x-show="show"
        x-cloak
        class="profile-modal-overlay"
        style="display: none;">
        
        <div class="profile-modal"
            x-show="show"
            x-transition:enter="ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            x-on:click.outside="show = false">
            
            <h3 class="profile-modal-title">Are you sure you want to delete your account?</h3>
            <p class="profile-modal-desc">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="profile-field">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password"
                        placeholder="Enter your password"
                        class="{{ $errors->userDeletion->get('password') ? 'has-error' : '' }}">
                    @error('password', 'userDeletion')
                        <p class="profile-field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="profile-modal-actions">
                    <button type="button" class="profile-btn--ghost"
                        x-on:click="$dispatch('close-modal', 'confirm-user-deletion'); show = false">
                        Cancel
                    </button>
                    <button type="submit" class="profile-btn profile-btn--danger">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
