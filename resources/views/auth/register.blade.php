<x-guest>
    <x-slot name="title">新規登録</x-slot>

    <form method="POST" action="{{ route('register') }}" class="auth-form" novalidate>
        @csrf

        <!-- Name -->
        <div class="auth-form__item">
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="名前" class="auth-form__input" />
            <x-input-error :messages="$errors->get('name')" class="auth-form__err" />
        </div>

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

        <!-- Confirm Password -->
        <div class="auth-form__item">
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="パスワード(確認)" class="auth-form__input" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="auth-form__err" />
        </div>

        <div class="auth-form__item">
            <x-primary-button class="auth-form__submit">
                {{ __('新規登録') }}
            </x-primary-button>
        </div>
    </form>
    <a class="auth-form__link" href="{{ route('login') }}">
        {{ __('すでにアカウントをお持ちの方') }}
    </a>
</x-guest>
