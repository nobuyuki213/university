<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
	// 複数代入設定
	protected $fillable = [
		'name', 'description', 'address', 'phone_number', 'url',
	];

	/**
	 * [reviews 大学に該当する複数のレビューと中間テーブルの fculty course を含めて全て取得するリレーション定義]
	 * @return [type] [description]
	 */
	public function reviews()
	{
		return $this->belongsToMany(Review::class, 'university_review')
					->withPivot('faculty', 'course', 'lesson')->withTimestamps();
	}

	/**
	 * [facultyReviews 大学に該当し学部名を指定した複数のレビューを取得]
	 * @param  [type] $faculty [学部インスタンス]
	 * @return [type]          [description]
	 */
	public function facultyReviews($faculty)
	{
		return $this->reviews()->where('faculty', $faculty->name);
	}

	/**
	 * [courseReviews 大学に該当し学科名を指定した複数のレビューを取得]
	 * @param  [type] $course [学科インスタンス]
	 * @return [type]         [description]
	 */
	public function courseReviews($course)
	{
		return $this->reviews()->where('course', $course->name);
	}
	/**
	 * [faculties 大学に属する複数の学部を取得するリレーション定義]
	 * @return [type] [description]
	 */
	public function facultyContents()
	{
		return $this->hasMany(FacultyContent::class);
	}

	/**
	 * [courseContents 大学に属する複数の学部コンテンツにさらに属する学科コンテンツを取得するリレーション定義]
	 * @return [type] [description]
	 */
	public function courseContents()
	{
		return $this->hasManyThrough(CourseContent::class, FacultyContent::class);
	}

	/**
	 * [Lessons 大学に属する複数の授業を取得するリレーション定義]
	 * @return [type] [description]
	 */
	public function lessons()
	{
		return $this->hasMany(Lesson::class);
	}
}


// faculty と多対多の関係で記述したコード
	// /**
	//  * [faculty_register 大学に学部を紐付けする処理]
	//  * @param  [type] $facultyId [学部id]
	//  * @return [type]            [description]
	//  */
	// public function faculty_register($facultyId)
	// {
	// 	// 既に紐付けしているかの確認
	// 	$exist = $this->is_faculty_registered($facultyId);
	// 	if ($exist) {
	// 		// 既に紐付け済みなら、何もしない
	// 		return false;
	// 	} else {
	// 		// まだ紐付けしていなければ、紐付けする
	// 		$this->faculties()->attach($facultyId);
	// 		return true;
	// 	}
	// }
	// /**
	//  * [faculty_register 大学に学部を紐付けを取り消しする処理]
	//  * @param  [type] $facultyId [学部id]
	//  * @return [type]            [description]
	//  */
	// public function faculty_cancel()
	// {
	// 	// 既に紐付けしているかの確認
	// 	$exist = $this->is_faculty_registered($facultyId);
	// 	if ($exist) {
	// 		// 既に紐付け済みなら、紐付けを取り消す
	// 		$this->faculties()->detach($facultyId);
	// 		return true;
	// 	} else {
	// 		// まだ紐付けしていなければ、何もしない
	// 		return false;
	// 	}
	// }
	// /**
	//  * [is_faculty_registered 大学に紐づいた学部が存在するか確認する処理]
	//  * @param  [type]  $facultyId [学部id]
	//  * @return boolean            [description]
	//  */
	// public function is_faculty_registered($facultyId)
	// {
	// 	return $this->faculties()->where('faculty_id', $facultyId)->exists();
	// }
// faculty と多対多の関係で記述したコード　ここまで 仮残し
