<section>
    <h2 class="profile-card-heading">Update Password</h2>
    <p class="profile-card-desc">
        Ensure your account is using a long, random password to stay secure.
    </p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div class="profile-field">
            <label for="update_password_current_password">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password"
                autocomplete="current-password"
                class="{{ $errors->updatePassword->get('current_password') ? 'has-error' : '' }}">
            @error('current_password', 'updatePassword')
                <p class="profile-field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- New Password --}}
        <div class="profile-field">
            <label for="update_password_password">New Password</label>
            <input id="update_password_password" name="password" type="password"
                autocomplete="new-password"
                class="{{ $errors->updatePassword->get('password') ? 'has-error' : '' }}">
            @error('password', 'updatePassword')
                <p class="profile-field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="profile-field">
            <label for="update_password_password_confirmation">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                autocomplete="new-password"
                class="{{ $errors->updatePassword->get('password_confirmation') ? 'has-error' : '' }}">
            @error('password_confirmation', 'updatePassword')
                <p class="profile-field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Save Button --}}
        <div class="profile-btn-row">
            <button type="submit" class="profile-btn">Save</button>

            @if (session('status') === 'password-updated')
                <span class="profile-success-msg" x-data="{ show: true }" x-show="show"
                    x-transition x-init="setTimeout(() => show = false, 2000)">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                    Saved.
                </span>
            @endif
        </div>
    </form>
</section>
