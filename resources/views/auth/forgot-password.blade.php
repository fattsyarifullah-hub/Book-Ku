<x-guest-layout>
    <div style="text-align: center; margin-bottom: 24px;">
        <h3 style="font-size: 20px; font-weight: 700; color: var(--text-primary); margin-bottom: 8px;">Lupa Password?</h3>
        <p style="font-size: 13px; color: var(--text-secondary); line-height: 1.5; margin: 0;">
            {{ __('Masukkan alamat email Anda yang terdaftar dan kami akan mengirimkan link untuk mereset password Anda.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">Email Address</label>
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com" />
            @if ($errors->has('email'))
                <span class="error-message">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="auth-actions" style="margin-top: 24px;">
            <div class="auth-actions__meta">
                <a class="auth-link" href="{{ route('login') }}">
                    &larr; <span>{{ __('Kembali ke Login') }}</span>
                </a>
            </div>

            <button type="submit" class="btn-auth" style="width: auto; padding: 10px 20px;">
                {{ __('Kirim Link Reset') }}
            </button>
        </div>
    </form>
</x-guest-layout>
