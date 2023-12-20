<x-guest>
    <x-slot name="title">ログイン</x-slot>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form" novalidate>
        @csrf

        <!-- Email Address -->
        <div class="auth-form__item">
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="メールアドレス" class="auth-form__input" />
            <x-input-error :messages="$errors->get('email')" class="auth-form__err" />
        </div>

        <!-- Password -->
        <div class="auth-form__item">
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="パスワード" class="auth-form__input" />

            <x-input-error :messages="$errors->get('password')" class="auth-form__err" />
        </div>

        <div class="auth-form__item">
            <x-primary-button class="auth-form__submit">
                {{ __('ログイン') }}
            </x-primary-button>
        </div>
    </form>
    @if (Route::has('password.request'))
    <a class="auth-form__link" href="{{ route('password.request') }}">
        {{ __('パスワードを忘れた方') }}
    </a>
    @endif
    <a class="auth-form__link no-margin" href="{{ route('register') }}">
        {{ __('まだアカウントをお持ちでない方') }}
    </a>
</x-guest>
