<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_verified', 'email_verify_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * [messageSending ユーザーが別のユーザーに送信したメッセージのリレーション定義]
     * @return [type] [description]
     */
    public function sendings()
    {
        return $this->belongsToMany(User::class, 'user_message', 'user_id', 'message_id')
                    ->withPivot('message')
                    ->withTimestamps();
    }
    /**
     * [receivings ユーザーが別のユーザーから受信したメッセージのリレーション定義]
     * @return [type] [description]
     */
    public function receivings()
    {
        return $this->belongsToMany(User::class, 'user_message', 'message_id', 'user_id')
                    ->withPivot('message')
                    ->withTimestamps();
    }

    /**
     * [sendAndReceives ユーザーと別のユーザーの送受信メッセージ全てを取得]
     * @param  [type] $userId [メッセージ相手のid]
     * @return [type]         [description]
     */
    public function sendAndReceives($userId)
    {
        return  \DB::table('user_message')->whereIn('user_id', [$this->id, $userId])->whereIn('message_id', [$this->id, $userId]);
    }

    /**
     * [messageSend ユーザーがメッセージを送信する(保存)]
     * @param  Request $requsrt [description]
     * @param  [type]  $userId  [メッセージ相手のid]
     * @return [type]           [description]
     */
    public function messageSend($request, $userId)
    {

        $its_me = $this->id == $userId;
        if ($its_me) {
            // 自分自身なら何もしない
            return flase;
        } else {
            // 自分自身でなければメッセージを送信(保存)する
            $this->sendings()->attach($userId, ['message' => $request->message]);
            return true;
        }
    }
}
