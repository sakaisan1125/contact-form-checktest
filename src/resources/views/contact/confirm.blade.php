@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-form">
  <h2 class="form-title">Confirm</h2>

  <form  method="POST">  
    @csrf
    <table class="confirm-table">
      <tr>
        <th>お名前</th>
        <td>{{ $inputs['last_name'] }}　{{ $inputs['first_name'] }}</td>
      </tr>
      <tr>
        <th>性別</th>
        <td>
          @if ($inputs['gender'] == '1') 男性
          @elseif ($inputs['gender'] == '2') 女性
          @else その他
          @endif
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $inputs['email'] }}</td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</td>
      </tr>
      <tr>
        <th>住所</th>
        <td>{{ $inputs['address'] }}</td>
      </tr>
      <tr>
        <th>建物名</th>
        <td>{{ $inputs['building'] }}</td>
      </tr>
      <tr>
        <th>お問い合わせの種類</th>
        <td>{{ $category_name }}</td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>{!! nl2br(e($inputs['detail'])) !!}</td>
      </tr>
    </table>

  @foreach ($inputs as $key => $value)
    @if (!in_array($key, ['tel1', 'tel2', 'tel3']))
      <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endif
  @endforeach
  <input type="hidden" name="tel1" value="{{ $inputs['tel1'] }}">
  <input type="hidden" name="tel2" value="{{ $inputs['tel2'] }}">
  <input type="hidden" name="tel3" value="{{ $inputs['tel3'] }}">
  <input type="hidden" name="action" value="submit">

  <div class="form-buttons">
    <button type="submit" formaction="/thanks" formmethod="POST">送信</button>
    <button type="submit" formaction="/" formmethod="GET">修正</button>
  </div>

  </form>
</div>
@endsection
