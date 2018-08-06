<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacultyContent extends Model
{
	//複数代入設定
	protected $fillable = [
		'university_id', 'faculty_id', 'overview',
	];
	/**
	 * [university 学部内容が所属している唯一の大学を取得するリレーション定義]
	 * @return [type] [description]
	 */
	public function university()
	{
		return $this->belongsTo(University::class);
	}
	/**
	 * [faculties 学部内容が持つ唯一の学部名を取得するリレーション定義]
	 * @return [type] [description]
	 */
	public function faculty()
	{
		return $this->belongsTo(Faculty::class);
	}
}
