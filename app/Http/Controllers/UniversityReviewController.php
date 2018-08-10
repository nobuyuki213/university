<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;
use App\Faculty;
use App\FacultyContent;
use App\Course;
use App\CourseContent;

class UniversityReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function select()
    {
        $universities = University::with('facultyContents', 'courseContents')->get();

        $faculties = Faculty::all();
        $courses = Course::all();

        return view('reviews.univer_select',
            compact('universities')
        );
    }

    public function input(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'select' => 'required',
        ]);
        // 配列で届く値を分けて使いやすくするため連想配列にする
        $ids = explode(',',$request->select);
        // dd($ids);
        if ($ids[0] && !empty($ids[1]) && !empty($ids[2])) {
            $university = University::find($ids[0]);
            $faculty = Faculty::find($ids[1]);
            $course = Course::find($ids[2]);

            return view('reviews.review_input',
                compact('university', 'faculty', 'course')
            );
        } else {
            return redirect()->back()->with('error', '大学、学部、学科のいずれかを選ばれていません');
        }
    }

    public function comfirm(Request $request)
    {
        // dd($request->has('body'));
        if ($request->has('body')) {
            // バリデーションチェック
            $this->validate($request, [
                'title' => 'required|string|max:35',
                'body' => 'required|string|unique:reviews,body|max:500',
                'body_rating' => 'required_unless:body,null|integer',
            ]);

            $university = University::find($request->university);
            $faculty = Faculty::find($request->faculty);
            $course = Course::find($request->course);
            // dd($faculty);
            return view('reviews.review_confirm',
                compact('request', 'university', 'faculty', 'course')
            );

        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
