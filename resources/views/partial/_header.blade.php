<header class="header">
  <div class="container">
    <div class="header__inner flex">
      <a href="{{ route('dashboard') }}">
        <h1>
          <img src="{{ asset('img/logo01.webp') }}" alt="顧客管理システム">
        </h1>
      </a>
      <nav class="flex">
        <a href="">顧客一覧</a>
        <a href="{{ route('items.index', 'any') }}">商品一覧</a>
        <a href="">購入履歴</a>
        <span>
          {{ Auth::user()->name }}
        </span>
        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
            this.closest('form').submit();">
            {{ __("Log Out") }}
          </x-dropdown-link>
        </form>
      </nav>
    </div>
  </div>
</header>
