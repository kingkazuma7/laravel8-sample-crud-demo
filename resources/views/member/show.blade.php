<h1>詳細表示</h1>

<ul>
<li>
名前
{{$member->name}}
</li>

<li>
電話番号
{{$member->telephone}}
</li>

<li>
メールアドレス
{{$member->email}}
</li>
</ul>

<a href="{{ route('member.index') }}">{{ __('一覧へ戻る') }}</a>