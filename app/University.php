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
	 * [faculties 大学に属する複数の学部を取得するリレーション定義]
	 * @return [type] [description]
	 */
	public function facultyContents()
	{
		return $this->hasMany(FacultyContent::class);
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
