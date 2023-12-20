<x-app>
  <!-- ページタイトル -->
  <x-slot name="title">ウエルカムページ</x-slot>

  <!-- ページコンテンツ -->
  <div class="root-btns flex">
    @if (Route::has('login'))
    <a href="{{ route('login') }}" class="root-btns__btn login">ログイン</a>
    @endif

    @if (Route::has('register'))
    <a href="{{ route('register') }}" class="root-btns__btn register">新規登録</a>
    @endif
  </div>
</x-app>
