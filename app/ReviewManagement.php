<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewManagement extends Model
{
    // 複数代入設定
    protected $fillable = [
    	'review_id', 'approved_date', 'is_approved', 'approved_admin', 'points_date', 'points', 'granted_admin',
    ];

    /**
     * [review レビューに属する唯一のレビュー管理を取得するリレーション定義]
     * @return [type] [description]
     */
    public function review()
    {
    	return $this->belongsTo(Review::class);
    }
}
