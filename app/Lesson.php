<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    // 複数代入設定
    protected $fillable = [
    	'university_id', 'faculty_id', 'course_id', 'name',
    ];

    /**
     * [university 授業の唯一の大学を取得するリレーション定義]
     * @return [type] [description]
     */
    public function university()
    {
    	return $this->belongsTo(university::class);
    }

    /**
     * [faculty 授業の唯一の学部名を取得するリレーション定義]
     * @return [type] [description]
     */
    public function faculty()
    {
    	return $this->belongsTo(Faculty::class);
    }

    /**
     * [course 授業の唯一の学科名を取得するリレーション定義]
     * @return [type] [description]
     */
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
