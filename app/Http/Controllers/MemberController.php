<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Member;
use App\Http\Requests\StoreMember; // 新規保存
use App\Http\Requests\UpdateMember; // 上書き保存

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //memberテーブルからname,telephone,emailを$membersに格納
        $members=DB::table('members')
        ->select('id', 'name', 'telephone', 'email')
        ->paginate(10);

        //viewを返す(compactでviewに$membersを渡す)
        return view('member/index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('member/create');
    }

    /**
     * Store a newly created resource in storage.
     * 新規追加画面で入力した値をDBに保存
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMember $request)
    {
        // todo: なぜ単数系?
        $member = new Member;
        $member->name=$request->input('name');
        $member->telephone=$request->input('telephone');
        $member->email=$request->input('email');
        $member->save();

        return redirect('member/index');
    }

    /**
     * Display the specified resource.
     * /member/show/idにアクセスした場合
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);
        return view('member/show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     * 編集(edit)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        return view('member/edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     * 編集画面で「更新」ボタンを押した時の動作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMember $request, $id)
    {
        $member = Member::find($id);

        $member->name=$request->input('name');
        $member->telephone=$request->input('telephone');
        $member->email=$request->input('email');

        // DBに保存
        $member->save();

        // 処理が終わったらmember/indexにリダイレクト
        return redirect('member/index');
    }

    /**
     * Remove the specified resource from storage.
     * /member/destroy/idにアクセスした場合
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();
        return redirect('member/index');
    }

    /**
     * 検索機能
     * memberテーブル内を検索し、結果をページネーションで表示する
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $search = $request->input('q');
        $query = DB::table('members');

        // 検索ワードの全角スペースを半角スペースに変換
        $search_spaceharf = mb_convert_kana($search, 's');
        
        // 検索ワードを半角スペースで区切る 不要な空白文字を削除
        $keyword_array = preg_split('/[\s]+/', $search_spaceharf, -1, PREG_SPLIT_NO_EMPTY);

        // 検索ワードをループで回してマッチするレコードを探す
        foreach ($keyword_array as $keyword) {
            $query->where('name', 'like', '%'.$keyword.'%')
						->orWhere('email', 'like', "%{$keyword}%");
        }

        $query->select('id', 'name', 'telephone', 'email');
        $members=$query->paginate(10);

        return view('member/index', compact('members'));
    }
}
