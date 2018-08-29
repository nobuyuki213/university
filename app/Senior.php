<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Senior extends Model
{
    // 複数代入設定
    protected $fillable = [
    	'lesson_id', 'comment',
    ];

    /**
     * [lesson 先輩の唯一の授業を取得するリレーション定義]
     * @return [type] [description]
     */
    public function lesson()
    {
    	return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}
