<h1>編集</h1>

<form method="POST" action="{{ route('member.update', ['id' => $member->id]) }}">
    @csrf
    <ul>
        <li>
            名前
            <input type="text" name=name value="{{$member->name}}">
						@error('name')
						{{$message}}
						@enderror
        </li>
        <li>
            電話番号
            <input type="text" name=telephone value="{{$member->telephone}}">
						@error('telephone')
						{{$message}}
						@enderror
        </li>
        <li>
            メールアドレス
            <input type="text" name=email value="{{$member->email}}">
						@error('email')
						{{$message}}
						@enderror
        </li>
    </ul>

    <input type="submit" value="更新する">
</form>
<a href="{{route('member.show',['id'=>$member->id])}}">{{ __('詳細に戻る') }}</a>