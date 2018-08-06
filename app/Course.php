<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // 複数代入設定
    protected $fillable = [
    	'name',
    ];
}
