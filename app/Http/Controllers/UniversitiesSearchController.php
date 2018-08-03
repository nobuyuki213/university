<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;

class UniversitiesSearchController extends Controller
{
    // university select view
    public function school()
    {
    	$universities = University::all();

    	$data = [
    		'universities' => $universities,
    	];

    	return view('universities.index', $data);
    }

}
