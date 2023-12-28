<x-app>
  <x-slot name="title">
    ダッシュボード
  </x-slot>

  <form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
    this.closest('form').submit();">
      {{ __("Log Out") }}
    </x-dropdown-link>
  </form>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          {{ __("You're logged in!") }}
        </div>
      </div>
    </div>
  </div>
</x-app>
