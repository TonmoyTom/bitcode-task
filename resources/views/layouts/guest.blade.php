<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.bundle.css') }}">

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
<nav class="navbar navbar-expand navbar-light bg-light">
  <div class="container">
    <div class="nav navbar-nav">
      <a class="nav-item nav-link active" href="#">Home <span class="visually-hidden"></span></a>
      @if(apiKey() && token())
        <a class="nav-item nav-link" href="{{ route('trello.information') }}">Trello Information </a>
        <a class="nav-item nav-link" href="{{ route('board.index') }}">Board List </a>
        <a class="nav-item nav-link" href="{{ route('purchase.index') }}">Purchase List </a>
        <a class="nav-item nav-link" href="{{ route('trello.logout') }}">Logout</a>
      @else
        <a class="nav-item nav-link" href="{{ route('trello.login') }}">Login</a>
      @endguest
    </div>
  </div>
</nav>

  <div class="font-sans text-gray-900 antialiased">
   @yield('content')
  </div>
</body>

</html>
