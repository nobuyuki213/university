<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    // 複数代入設定
    protected $fillable = ['name'];

    /**
     * [lessons タグに紐づいている複数の授業を取得するリレーション定義]
     * @return [type] [description]
     */
    public function lessons()
    {
    	return $this->belongsToMany(Lesson::class, 'lesson_tag', 'tag_id', 'lesson_id')->withTimestamps();
    }
}
