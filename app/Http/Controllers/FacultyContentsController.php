<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;
use App\Faculty;
use App\FacultyContent;

class FacultyContentsController extends Controller
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
    public function create($id)
    {
        //
        $university = University::find($id);
        // 大学に所属している学部内容と合わせて、大学と学部名のみを取得
        $faculty_contents = $university->facultyContents()->with('university', 'faculty')->get();
        // 大学に所属していない学部名のみを取得
        $faculty_names = Faculty::whereDoesntHave('facultyContents', function($quesry)use($university){
            $quesry->where('university_id', $university->id);
        })->get();

        $data = [
            'university' => $university,
            'faculty_names' => $faculty_names,
            'faculty_contents' => $faculty_contents,
        ];

        return view('faculties_contents.select_faculty', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        // dd($request->all());
        $this->validate($request, [
            'faculty_id' => 'required|integer',
            'overview' => 'required|string|max:500'
        ]);

        $university = University::find($id);
        $faculty = Faculty::find($request->faculty_id);

        $faculty_contens = $university->facultyContents()->create([
            'faculty_id' => $faculty->id,
            'overview' => $request->overview,
        ]);

        return redirect()->back()->with('set_faculty', $university->name . ' に ' . $faculty->name.' を登録しました');
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
    public function edit(Request $request, $id)
    {
        //
        // dd($request->all());
        $university = University::find($id);
        // 大学に所属している学部内容と合わせて、大学と学部名のみを取得
        $faculty_contents = $university->facultyContents()->with('university', 'faculty')->get();
        // $request で受け取った faculty_id で 編集する faculty を取得する
        $faculty = Faculty::find($request->faculty);

        $f_content = FacultyContent::where('university_id', $university->id)->where('faculty_id', $faculty->id)->first();
        // dd($faculty_contents);

        $data = [
            'university' => $university,
            'faculty_contents' => $faculty_contents,
            'faculty' => $faculty,
            'f_content' => $f_content,
        ];
        return view('faculties_contents.edit', $data);
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
        // dd($request->all());
        $this->validate($request, [
            'facultyContent' => 'required|integer',
            'faculty_id' => 'required|integer',
            'overview' => 'required|string|max:500'
        ]);

        $university = University::find($id);
        $faculty = Faculty::find($request->faculty_id);

        $faculty_contens = FacultyContent::find($request->facultyContent);
        $faculty_contens->overview = $request->overview;
        $faculty_contens->save();

        return redirect()->back()->with('update_faculty', $university->name . ' の ' . $faculty->name.' を編集し確定しました');

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
