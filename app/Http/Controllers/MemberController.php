<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Member;
use App\Http\Requests\StoreMember;

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
        ->get();

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
    public function update(Request $request, $id)
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
}
