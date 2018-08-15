<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // 複数代入設定
    protected $fillable = [
    	'name',
    ];
    /**
     * [coursesContents 学科名に属する複数の学科コンテンツを取得するリレーション定義]
     * @return [type] [description]
     */
    public function courseContents()
    {
    	return $this->hasMany(CourseContent::class);
    }

    /**
     * [Lessons 学科名に属する複数の授業を取得するリレーション定義]
     * @return [type] [description]
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
