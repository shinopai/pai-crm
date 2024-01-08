<x-app>
  <x-slot name="title">商品一覧</x-slot>

  <div class="table-wrap">
    @if ($items->isNotEmpty())
    <table class="table">
      <caption>商品一覧</caption>
      <tr>
        <td class="heading">商品名</td>
        <td class="heading">値段</td>
        <td class="heading">登録日</td>
      </tr>
      @foreach ($items as $item)
      <tr>
        <td>{{ $item->name }}</td>
        <td>{{ number_format($item->price) }}</td>
        <td>{{ Carbon\Carbon::parse($item->created_at)->format('Y年m月d日 h時m分') }}</td>
      </tr>
      @endforeach
    </table>
    @else
    <p>商品はありません</p>
    @endif
  </div>
  {{ $items->links('vendor.pagination.default') }}
</x-app>
