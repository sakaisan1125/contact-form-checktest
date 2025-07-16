@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="login-page">
  <h1 class="login-page__title">Register</h1>

  <div class="login-form__container">
    <form method="POST" action="{{ route('register') }}" novalidate>
      @csrf

      <div class="form-group">
        <label for="name">お名前</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="例：山田　太郎">
        @error('name')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="email">メールアドレス</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="例：test@example.com">
        @error('email')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">パスワード</label>
        <input id="password" type="password" name="password" required placeholder="例：coachtech1106">
        @error('password')
          <p class="error-message">{{ $message }}</p>
        @enderror
      </div>

      <div class="form-group">
        <button type="submit" class="login-button">登録</button>
      </div>
    </form>
  </div>
</div>
@endsection
