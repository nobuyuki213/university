<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;
use App\Lesson;
use App\Tag;

class UniversitiesController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $university = new University();
        $universities = University::all();

        return view('universities.create',
            compact('university', 'universities')
        );
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
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:500',
            'address' => 'required|string|max:191',
            'phone_number' => 'required|regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/',
            'url' => 'required|string|url|max:191',
        ]);

        $university = new University();
        $university->name = $request->name;
        $university->description = $request->description;
        $university->address = $request->address;
        $university->phone_number = $request->phone_number;
        $university->url = $request->url;
        $university->save();

        return redirect()->back()->with('create', $resuest->name.' を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // 授業の絞り込み処理を実行
        $search_lessons = Lesson::search($request);
        $message = $search_lessons['message'];
        $search_lessons = $search_lessons['lessons'];

        // $request の中にある[学科のids][学年][タグのids] を変数に代入する
        $course_ids = $request->course_ids;
        $school_years = $request->school_years;
        $tag_ids = $request->tag_ids;

        $university = University::with('courseContents')->get()->find($id);
        $lessons = University::find($id)->lessons->all();
        $tags = Tag::all();
        // dd($lessons);

        if ($message) {
            return view('universities.show',
                compact('university', 'lessons', 'tags', 'course_ids', 'school_years', 'tag_ids', 'search_lessons', 'message')
            );
        } else {
            return view('universities.show',
                compact('university', 'lessons', 'tags', 'course_ids', 'school_years', 'tag_ids', 'search_lessons')
            );
        }

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
