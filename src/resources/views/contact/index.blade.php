@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form">
  <h2 class="form-title">Contact</h2>
  <form action="/confirm" method="POST" class="form">
    @csrf

    <div class="form-group">
      <label>お名前<span style="color: red;">※</span></label>
      <div class="name-inputs">
        <input type="text" name="last_name" value="{{ old('last_name') }}" class="input input--name" placeholder="例：山田">
        <input type="text" name="first_name" value="{{ old('first_name') }}" class="input input--name" placeholder="例：太郎">
      </div>
      @if ($errors->has('last_name'))
      <p class="error-message">{{ $errors->first('last_name') }}</p>
      @endif
      @if ($errors->has('first_name'))
      <p class="error-message">{{ $errors->first('first_name') }}</p>
      @endif
    </div>

    <div class="form-group">
      <label>性別<span style="color: red;">※</span></label>
      <div class="gender-options">
        <label class="gender-option"><input type="radio" name="gender" value="1" {{ old('gender','1') == '1' ? 'checked' : '' }}> 男性</label>
        <label class="gender-option"><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
        <label class="gender-option"><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
      </div>
      @if ($errors->has('gender'))
      <p class="error-message">{{ $errors->first('gender') }}</p>
      @endif
    </div>

    <div class="form-group">
      <label>メールアドレス<span style="color: red;">※</span></label>
      <div class="email-inputs">
      <input type="email" name="email" value="{{ old('email') }}" class="input input--email" placeholder="例：test@example.com">
      </div>
      @if ($errors->has('email'))
        <p class="error-message">{{ $errors->first('email') }}</p>
      @endif
    </div>

    <div class="form-group">
  <label>電話番号<span style="color: red;">※</span></label>
  <div class="tel-inputs">
    <input type="text" name="tel1" value="{{ old('tel1') }}" class="input input--tel" placeholder="080">
    <span class="tel-hyphen">-</span>
    <input type="text" name="tel2" value="{{ old('tel2') }}" class="input input--tel" placeholder="1234">
    <span class="tel-hyphen">-</span>
    <input type="text" name="tel3" value="{{ old('tel3') }}" class="input input--tel" placeholder="5678">
  </div>
  @if ($errors->any() && $errors->has('tel1'))
  <p class="error-message">{{ $errors->first('tel1') }}</p>
  @endif
  @if ($errors->any() && $errors->has('tel2'))
    <p class="error-message">{{ $errors->first('tel2') }}</p>
  @endif
  @if ($errors->any() && $errors->has('tel3'))
    <p class="error-message">{{ $errors->first('tel3') }}</p>
  @endif
</div>

    <div class="form-group">
      <label>住所<span style="color: red;">※</span></label>
      <div class="address-inputs">
      <input type="text" name="address" value="{{ old('address') }}" class="input input--address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3">
      </div>
      @if ($errors->has('address'))
        <p class="error-message">{{ $errors->first('address') }}</p>
      @endif
    </div>

    <div class="form-group">
      <label>建物名</label>
      <div class="building-inputs">
      <input type="text" name="building" value="{{ old('building') }}" class="input input--building" placeholder="例：千駄ヶ谷マンション101">
      </div>
    </div>

    <div class="form-group">
      <label>お問い合わせの種類<span style="color: red;">※</span></label>
      <div class="category_id-inputs">
      <select name="category_id" class="select select--category">
        <option value="">選択してください</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
          </option>
        @endforeach
      </select>
      </div>
      @if ($errors->has('category_id'))
        <p class="error-message">{{ $errors->first('category_id') }}</p>
      @endif
    </div>

    <div class="form-group">
      <label>お問い合わせ内容<span style="color: red;">※</span></label>
      <div class="detail-inputs">
      <textarea name="detail" class="textarea textarea--detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
      </div>
      @if ($errors->has('detail'))
        <p class="error-message">{{ $errors->first('detail') }}</p>
      @endif
    </div>

    <button type="submit" class="submit-button">確認画面</button>
  </form>
</div>
@endsection
