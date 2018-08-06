<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    //複数代入設定
    protected $fillable = [
    	'name',
    ];
    /**
     * [facultyContens 学部名に属する複数の学部内容を取得するリレーション定義]
     * @return [type] [description]
     */
    public function facultyContents()
    {
    	return $this->hasMany(FacultyContent::class);
    }
}
