<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@example.com" />
            @if ($errors->has('email'))
                <span class="error-message">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <!-- Password -->
        <div class="form-group">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <label for="password" class="form-label" style="margin-bottom: 0;">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size: 12px; color: var(--primary); text-decoration: none; font-weight: 500;">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            @if ($errors->has('password'))
                <span class="error-message">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <!-- Remember Me -->
        <div class="form-group" style="display: flex; align-items: center; gap: 8px; margin-top: 24px; margin-bottom: 24px;">
            <input id="remember_me" type="checkbox" name="remember" style="width: 16px; height: 16px; accent-color: var(--primary); cursor: pointer;" />
            <label for="remember_me" style="font-size: 13px; color: var(--text-secondary); cursor: pointer;">Remember me on this device</label>
        </div>

        <div class="auth-actions">
            <div class="auth-actions__meta">
                @if (request()->getHost() == "booku.local")
                    <a class="auth-link" href="{{ route('register') }}">
                        {{ __('Don’t have an account?') }} <span>{{ __('Sign up') }}</span>
                    </a>
                @endif
            </div>

            <x-primary-button class="auth-submit">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
