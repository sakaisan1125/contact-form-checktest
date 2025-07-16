<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FashionablyLate</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">FashionablyLate</a>

      <div class="header__buttons">
        @auth
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">logout</button>
          </form>
        @else
          @if (request()->is('login'))
            <a href="{{ route('register') }}" class="register-button">register</a>
          @elseif (request()->is('register'))
            <a href="{{ route('login') }}" class="register-button">login</a>
          @endif
        @endauth
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>
</html>
