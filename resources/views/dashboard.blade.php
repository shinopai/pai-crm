<x-app>
  <x-slot name="title">
    ダッシュボード
  </x-slot>

  <!-- header -->
  @include('partial._header')

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          {{ __("You're logged in!") }}
        </div>
      </div>
    </div>
  </div>

  <div class="dsbd-menus flex">
    <div class="dsbd-menus__item">
      <h2>顧客一覧</h2>
    </div>
    <div class="dsbd-menus__item">
      <h2>商品一覧</h2>
      <ul>
        @if($items->isNotEmpty())
        @foreach ($items as $item)
        <li>{{ $item->name }}</li>
        @endforeach
        <li>
          <a href="">一覧ページへ</a>
        </li>
        @else
        <li>顧客はありません</li>
        @endisset
      </ul>
    </div>
    <div class="dsbd-menus__item">
      <h2>購入履歴</h2>
      <ul>
        <li></li>
      </ul>
    </div>
  </div>
</x-app>
