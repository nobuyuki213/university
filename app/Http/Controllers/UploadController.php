<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class UploadController extends Controller
{

	public function updateAvatar(Request $request)
	{
		//ファイルのバリデーション
		$this->validate($request, [
			'avatar' => 'required|file|image',
		]);
		// ファイルの存在を確認する
		if ($request->hasFile('avatar')) {
			// $request から file を受け取り $avatar 変数に代入
			$avatar = $request->file('avatar');
			$user = \Auth::user();
			// 画像ファイル名を時刻に変換し、アップした画像の拡張子を取得
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			// ユーザーid毎にフォルダ分けするために、 $user->id と一致するフォルダが無い場合、新規作成
			if (!file_exists(public_path('storage/avatars/' . $user->id))) {
				mkdir(public_path('storage/avatars/' . $user->id));
			}
			// 幅を250px指定で高さは自動処理でリサイズし、 storage/avatars　ディレクトリに　'200x200-$filename'で画像を保存
			Image::make($avatar)->resize(250, null, function($constraint){
				$constraint->aspectRatio();
			})->crop(200,200)->save(public_path('storage/avatars/' . $user->id . '/' . '200x200-' . $filename));

			// 画像ファイル名を avatar に保存
			$user->avatar = '200x200-' . $filename;
			$user->save();
		}
		return redirect()->back();
	}

}
