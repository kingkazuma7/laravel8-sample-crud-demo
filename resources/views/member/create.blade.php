<h1>新規作成</h1>

<form method="POST" action="{{ route('member.store') }}">
  @csrf

  <div>
    <label for="form-name">名前</label>
    <input type="text" name="name" id="form-name" required>
  </div>

  <div>
    <label for="form-tel">電話番号</label>
    <input type="tel" name="telephone" id="form-tel">
  </div>

  <div>
    <label for="form-email">メールアドレス</label>
    <input type="email" name="email" id="form-email">
  </div>

  <button type="submit">登録</button>

</form>

<a href="{{ route('member.index') }}">{{ __('一覧へ戻る') }}</a>