<h1>一覧表示</h1>

<table>
<tr>
<th>ID</th>
<th>名前</th>
<th>電話番号</th>
<th>メールアドレス</th>
</tr>
@foreach($members as $member)
<tr>
<td>{{$member->id}}</td>
<td>{{$member->name}}</td>
<td>{{$member->telephone}}</td>
<td>{{$member->email}}</td>
<td><a href="{{ route('member.show', ['id' => $member->id]) }}">詳細</a></td>
</tr>
@endforeach
</table>

<a href="{{ route('member.create') }}">{{ __('新規作成') }}</a>