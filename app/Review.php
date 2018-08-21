<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // 複数代入設定
    protected $fillable = [
    	'user_id', 'title', 'body', 'rating',
    ];

    /**
     * [user レビューの唯一のユーザーを取得するリレーション定義]
     * @return [type] [description]
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /**
     * [reviewManagement レビューに関するレビュー管理を取得する]
     * @return [type] [description]
     */
    public function reviewManagement()
    {
        return $this->hasOne(ReviewManagement::class);
    }

    /**
     * [universities レビューに該当する複数の大学と中間テーブルの fculty course を含めて全て取得するリレーション定義]
     * @return [type] [description]
     */
    public function universities()
    {
    	return $this->belongsToMany(University::class, 'university_review')
                    ->withPivot('faculty', 'course', 'lesson')->withTimestamps();
    }
}
