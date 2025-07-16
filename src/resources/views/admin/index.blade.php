@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin">
  <h1 class="admin__title">Admin</h1>
  <form method="GET" action="/admin" class="admin__search-form">
  <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください" />
  <select name="gender">
    <option value="">性別</option>
    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
  </select>
  <select name="category_id">
    <option value="">お問い合わせの種類</option>
    @foreach($categories as $category)
      <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
    @endforeach
  </select>
  <input type="date" name="created_at" value="{{ request('created_at') }}" />
  <button type="submit">検索</button>
  <a href="/admin">リセット</a>
</form>
<div class="pagination">
    <div class="admin__export">
  <form method="GET" action="{{ route('admin.export') }}">
    <input type="hidden" name="keyword" value="{{ request('keyword') }}">
    <input type="hidden" name="gender" value="{{ request('gender') }}">
    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
    <input type="hidden" name="created_at" value="{{ request('created_at') }}">
    <button type="submit">エクスポート</button>
  </form>
</div>

  {{ $contacts->appends(request()->query())->links() }}
</div>

    <table class="admin__table">
    <thead>
      <tr>
        <th>お名前</th>
        <th>性別</th>
        <th>メールアドレス</th>
        <th>お問い合わせ種類</th>
        <th></th>
      </tr>
    </thead>
<tbody>
  @foreach($contacts as $contact)
  <tr>
    <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
    <td>
      @if($contact->gender == 1) 男性
      @elseif($contact->gender == 2) 女性
      @else その他
      @endif
    </td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->category->content }}</td>
    <td><label for="modal-{{ $contact->id }}" class="detail-link">詳細</label></td>
  </tr>

<input type="checkbox" id="modal-{{ $contact->id }}" class="modal-toggle" hidden>
<div class="modal">
  <label for="modal-{{ $contact->id }}" class="modal-overlay"></label>
  <div class="modal-content">
    <label for="modal-{{ $contact->id }}" class="modal-close">×</label>

    <div class="modal-row">
      <span class="label">お名前</span>
      <span class="value">{{ $contact->last_name }} {{ $contact->first_name }}</span>
    </div>

    <div class="modal-row">
  <span class="label">性別</span>
  <span class="value">{{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</span>
  </div>


    <div class="modal-row">
      <span class="label">メールアドレス</span>
      <span class="value">{{ $contact->email }}</span>
    </div>

    <div class="modal-row">
      <span class="label">電話番号</span>
      <span class="value">{{ $contact->tel }}</span>
    </div>

    <div class="modal-row">
      <span class="label">住所</span>
      <span class="value">{{ $contact->address }}</span>
    </div>

    <div class="modal-row">
      <span class="label">建物名</span>
      <span class="value">{{ $contact->building }}</span>
    </div>

    <div class="modal-row">
      <span class="label">お問い合わせ種類</span>
      <span class="value">{{ $contact->category->content }}</span>
    </div>

    <div class="modal-row">
      <span class="label">お問い合わせ内容</span>
      <span class="value" style="white-space: pre-wrap;">{{ $contact->detail }}</span>
    </div>
    <div class="modal-button">
      <form method="POST" action="{{ route('contacts.destroy', $contact->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
      </form>
    </div>
  </div>
</div>
  @endforeach
</tbody>   
  </table>
</div>
@endsection
