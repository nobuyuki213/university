<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Review;

class UsersController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::findOrFail($id);
        $sent_msgs = $user->sendings()->get();
        $receive_msgs = $user->receivings()->get();

        // dd($sent_msgs);

        $data = [
            'user' => $user,
            'sent_msgs' => $sent_msgs,
            'receive_msgs' => $receive_msgs,
        ];

        return view('users.show', $data);
    }

    /**
     * [userReviews ユーザーのレビュー一覧ページ]
     * @return [type] [description]
     */
    public function userReviews($id)
    {
        $user = User::findOrFail($id);
        $reviews = $user->reviews()->with('user','universities')->get();
// dd($reviews);
        return view('users.user_reviews',
            compact('user', 'reviews')
        );
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
