<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    // 複数代入設定
    protected $fillable = [
    	'faculty_content_id', 'course_id', 'feature',
    ];
    /**
     * [facultyContent 学科内容が所属している唯一の学部内容を取得するリレーション定義]
     * @return [type] [description]
     */
    public function facultyContent()
    {
    	return $this->belongsTo(FacultyContent::class);
    }
    /**
     * [course 学科内容が持つ唯一の学科名を取得するリレーション定義]
     * @return [type] [description]
     */
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
