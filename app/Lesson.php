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

    /**
     * [tags 授業に紐づいている複数のタグを取得するリレーション定義]
     * @return [type] [description]
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'lesson_tag', 'lesson_id', 'tag_id')->withTimestamps();
    }

    /**
     * [scopesearch 授業絞り込み処理]
     * @param  [type] $query   [description]
     * @param  [type] $request [description]
     * @param  [type] $id      [university]
     * @return [type]          [description]
     */
    public function scopesearch($query, $request, $id)
    {
        $lessons_query = self::query();
        $hasParam = true;

        if ($request->all()) {
            $lessons = $lessons_query->where('university_id', $id);

            if ($request->has('course_ids')) {
                $lessons = $lessons_query->whereIn('course_id', $request->course_ids);
            }
            if ($request->has('school_years')) {
                $lessons = $lessons_query->whereIn('school_year', $request->school_years);
            }
            // タグの絞り込み検索は、タグ内で and検索 となる
            if ($request->has('tag_ids')) {
                $lessons = $lessons_query->whereHas('tags', function ($query) use ($request) {
                    foreach ($request->tag_ids as $key => $tag_id) {
                        $query->where('tags.id', $tag_id);
                    }
                });
            }

            $lessons = $lessons_query->get();

        } else {
            $hasParam = false;
            $lessons = $lessons_query;
        }

        $data = [];

        if ($lessons->count() <= 0 && $hasParam) {
            $data['message'] = '該当する授業はありませんでした。';
        } else {
            $data['message'] = "";
        }
        $data['lessons'] = $lessons;

        return $data;
    }
}
