<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    // 複数代入設定
    protected $fillable = [
    	'name', 'description', 'address', 'phone_number', 'url',
    ];
}
