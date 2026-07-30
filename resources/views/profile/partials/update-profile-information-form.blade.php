<section>
    <h2 class="profile-card-heading">Profile Information</h2>
    <p class="profile-card-desc">
        Update your account's profile information and email address.
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        {{-- Name --}}
        <div class="profile-field">
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                required autofocus autocomplete="name"
                class="{{ $errors->get('name') ? 'has-error' : '' }}">
            @error('name')
                <p class="profile-field-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="profile-field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                required autocomplete="username"
                class="{{ $errors->get('email') ? 'has-error' : '' }}">
            @error('email')
                <p class="profile-field-error">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="profile-verify-banner">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
                        <path d="M12 8v4M12 16h.01"/>
                    </svg>
                    <span>Your email address is unverified.</span>
                    <button form="send-verification">Click here to re-send the verification email.</button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="profile-verify-sent">A new verification link has been sent to your email address.</p>
                @endif
            @endif
        </div>

        {{-- Save Button --}}
        <div class="profile-btn-row">
            <button type="submit" class="profile-btn">Save</button>

            @if (session('status') === 'profile-updated')
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
