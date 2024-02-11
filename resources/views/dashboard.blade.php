<x-app>
  <x-slot name="title">
    ダッシュボード
  </x-slot>

  <!-- フラッシュメッセージ -->
  <div class="flash-msg--success" id="flash_msg_success">
    {{ __("You're logged in!") }}
  </div>

  <div class="dsbd-menus flex">
    <div class="dsbd-menus__item">
      <h2>顧客一覧</h2>
      <ul>
        @if($customers->isNotEmpty())
        @foreach ($customers as $customer)
        <li>{{ $customer->name }}</li>
        @endforeach
        <li>
          <a href="{{ url('/customers') }}">一覧ページへ</a>
        </li>
        @else
        <li>顧客はありません</li>
        @endisset
      </ul>
    </div>
    <div class="dsbd-menus__item">
      <h2>商品一覧</h2>
      <ul>
        @if($items->isNotEmpty())
        @foreach ($items as $item)
        <li>{{ $item->name }}</li>
        @endforeach
        <li>
          <a href="{{ url('/items') }}">一覧ページへ</a>
        </li>
        @else
        <li>商品はありません</li>
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
