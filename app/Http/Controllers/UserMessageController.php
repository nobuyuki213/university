<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // ログイン済みの確認
        if (\Auth::check()) {
            // message のバリデーション
            $request->validate([
                'message' => 'required|string|max:140',
            ]);
            // message の送信(保存) 実行
            \Auth::user()->messageSend($request, $id);

            return redirect()->back()->with('send', 'メッセージを送信しました');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if (\Auth::check()){
            $user = User::find($id);
            $all_messages = $user->sendAndReceives($request->user)->get();
            // dd($all_message);
            return view('users.messages', [
                'user' => $user,
                'part_user' => User::find($request->user),
                'all_messages' => $all_messages,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
