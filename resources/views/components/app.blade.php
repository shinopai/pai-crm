<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>{{ config("app.name", "Laravel") }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net" />
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!-- Scripts -->
  @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
  <!-- header -->
  @include('partial._header')

  <main>
    <div class="container">
      {{ $slot }}
    </div>
  </main>

  <script>
    $(function(){
      // 5秒後にフラッシュメッセージを消す
      $('#flash_msg_success').fadeOut(5000);
    })
  </script>
</body>

</html>
