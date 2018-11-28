<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{asset("css/app.css")}}">
  @stack('styles')
  <title>メールマガジン送信システム</title>
</head>
<body>
<div id="app">
  <header>
    <header-nav active="{{request()->path()}}"></header-nav>
  </header>
  <section class="content">
    @yield('content')
  </section>
</div>
<script src="{{asset('js/app.js')}}"></script>
@stack('scripts')
</body>
</html>