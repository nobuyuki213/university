<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PasswordResetNotification;
use App\Faculty;
use App\Course;
use App\Lesson;

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
     * [sendPasswordResetNotification パスワードリセット通知の送信をオーバーライド]
     * @param  [string] $token [description]
     * @return [void]        [description]
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    /**
     * [reviews ユーザーが投稿した複数のレビューを取得するリレーション定義]
     * @return [type] [description]
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * [reviewManagements ユーザーが投稿した複数のレビューのレビュー操作管理データを取得するリレーション定義]
     * @return [type] [description]
     */
    public function reviewManagements()
    {
        return $this->hasManyThrough(ReviewManagement::class, Review::class);
    }

    /**
     * [messageSending ユーザーが別のユーザーに送信したメッセージを取得するリレーション定義]
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


    public function createReview($request, $universityId)
    {
        // dd($faculty = Faculty::find($request->faculty));
        // $request に body=(総合評価のレビュー本文)が存在し、かつ空でないかを確認
        if ($request->filled('body')) {
            // 平均レーティングを計算するために各レーティングを $ratings 変数に配列で追加する
            if($request->filled('body_rating')) { $ratings[] = $request->body_rating; }//行数を増やさないために一行で記述している
            // 新しいレーティングを追加した場合、<<ここの行>>に上記のコードを参照して追加する
            $rating_count = count($ratings); //ratingされた数を取得する
            $total_rating = 0; // rating の合計数値を計算するために初期値 0 の変数を作る
            foreach ($ratings as $rating) {
                $total_rating += $rating;
            }
            $avg_rating = round($total_rating / $rating_count);// 四捨五入でrating の平均値 を算出する
// dd($avg_rating);
            // ユーザーに紐づくレビューの値を作成して保存
            $review = $this->reviews()->create([
                'title' => $request->title,
                'body' => $request->body,
                'rating' => $avg_rating,
            ]);
            // レビュー紐づく関係性と学部名、学科名、授業名も含めて保存
            $faculty = Faculty::find($request->faculty);
            $course = Course::find($request->course);
            $lesson = Lesson::find($request->lesson);
            $review->universities()->attach($universityId, ['faculty' => $faculty->name, 'course' => $course->name, 'lesson' => $lesson->name]);
            // レビュー作成にと同時にレビューを管理するインスタンスを作成
            $review_management = $review->reviewManagement()->create([
                'review_id' => $review->id,
            ]);

            $data = [
                'review' => $review,
            ];

            return $data;
        } else {
            return false;
        }
    }
}
