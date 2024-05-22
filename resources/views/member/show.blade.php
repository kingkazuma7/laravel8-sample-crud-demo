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

<form method="POST" action="{{ route('member.destroy', ['id' => $member->id]) }}">
@csrf
<button type="submit">削除</button>
</form>

<a href="{{route('member.edit',['id'=>$member->id])}}">{{ __('編集') }}</a>
<a href="{{ route('member.index') }}">{{ __('一覧へ戻る') }}</a>