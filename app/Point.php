<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    // 複数代入の設定
    protected $fillable = [
    	'user_id', 'points'
    ];

    /**
     * [user ポイントの唯一のユーザーを取得するリレーション定義]
     * @return [type] [description]
     */
    public function review()
    {
    	return $this->belongsTo(Review::class);
    }
}
