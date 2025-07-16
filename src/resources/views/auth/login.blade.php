@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="login-page">
  <h1 class="login-page__title">Login</h1>

  <div class="login-form__container">

    @if (session('status'))
      <div class="error-message">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
      @csrf

      <div class="form-group">
        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" placeholder="例: test@example.com" required autofocus value="{{ old('email') }}">
        @error('email')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">パスワード</label>
        <input id="password" type="password" name="password" placeholder="例: coachtech1106" required>
        @error('password')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <button type="submit" class="login-button">ログイン</button>
      </div>
    </form>
  </div>
</div>
@endsection
