<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;
use App\Faculty;
use App\FacultyContent;
use App\Course;
use App\CourseContent;
use App\Lesson;

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
        $universities = University::with('facultyContents', 'courseContents', 'lessons')->get();

        $faculties = Faculty::all();
        $courses = Course::all();

        return view('reviews.univer_select',
            compact('universities')
        );
    }

    /**
     * [input description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function input(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'select' => 'required',
        ]);
        // 配列で届く値を分けて使いやすくするため連想配列にする
        $ids = explode(',',$request->select);
        // dd($ids);
        if ($ids[0] && !empty($ids[1]) && !empty($ids[2]) && !empty($ids[3])) {
            $university = University::find($ids[0]);
            $faculty = Faculty::find($ids[1]);
            $course = Course::find($ids[2]);
            $lesson = Lesson::find($ids[3]);

            return view('reviews.review_input',
                compact('university', 'faculty', 'course', 'lesson')
            );
        } else {
            return redirect()->back()->with('error', '大学、学部、学科、授業のいずれかを選ばれていません');
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
            $lesson = Lesson::find($request->lesson);
            // dd($faculty);
            return view('reviews.review_confirm',
                compact('request', 'university', 'faculty', 'course', 'lesson')
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
