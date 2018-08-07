<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\University;
use App\Faculty;
use App\FacultyContent;
use App\Course;
use App\CourseContent;

class CourseContentsController extends Controller
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
     * [select description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function select($id)
    {
        //
        $university = University::find($id);
        // 大学に所属している学部内容と合わせて、大学と学部名のみを取得
        $faculty_contents = $university->facultyContents()->with('university', 'faculty')->get();

        $data = [
            'university' => $university,
            'faculty_contents' => $faculty_contents,
        ];

        return view('course_contents.select', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @param $u_id => university_id
     * @param $f_id => facultyContent_id
     * @return \Illuminate\Http\Response
     */
    public function create($u_id, $f_id)
    {
        //
        $university = University::find($u_id);
        // 特定の学部コンテンツを取得
        $faculty_content = FacultyContent::find($f_id);
        // dd($faculty_content);
        $faculty = $faculty_content->faculty;
        // dd($faculty);
        // 学部コンテンツに所属している学科内容を取得（+学部コンテンツ +学科名）
        $course_contents = $faculty_content->courseContents()->with('facultyContent', 'course')->get();
        // dd($course_contents);
        // 学部コンテンツに所属していない学科名のみを取得
        $course_names = Course::whereDoesntHave('courseContents', function($query)use($faculty_content){
            $query->where('faculty_content_id', $faculty_content->id);
        })->get();
        // dd($course_names);
        $data = [
            'university' => $university,
            'faculty_content' => $faculty_content,
            'faculty' => $faculty,
            'course_contents' => $course_contents,
            'course_names' => $course_names,
        ];

        return view('course_contents.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $u_id, $f_id)
    {
        //
        // dd($request->all());
        $this->validate($request, [
            'course_id' => 'required|integer',
            'feature' => 'required|string|max:500'
        ]);

        $university = University::find($u_id);
        // 学部コンテンツをセットするため $f_id で学部コンテンツインスタンスを特定して取得
        $faculty_content = FacultyContent::find($f_id);
        // 学科名をセットするため course_id で学科インスタンスを特定してを取得
        $course = Course::find($request->course_id);

        $cours_contens = $faculty_content->courseContents()->create([
            'course_id' => $course->id,
            'feature' => $request->feature,
        ]);

        return redirect()->back()->with(
            'create_course', $university->name . ' / ' . $faculty_content->faculty->name . 'に' . $course->name . ' を登録しました'
        );
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
    public function edit($u_id, $f_id, $c_id)
    {
        //
        $university = University::find($u_id);
        // 特定の学部コンテンツを取得
        $faculty_content = FacultyContent::find($f_id);
        // 学部コンテンツの唯一の学部名を取得
        $faculty = $faculty_content->faculty;
        // 編集する学科コンテンツを取得
        $course_content = CourseContent::find($c_id);
        // 編集する学科コンテンツ唯一の学科名を取得
        $course = $course_content->course;
        // 学部コンテンツに所属している学科コンテンツを取得（+学科名）
        $course_contents = $faculty_content->courseContents()->with('course')->get();
        // dd($course_content);

        $data = [
            'university' => $university,
            'faculty_content' => $faculty_content,
            'faculty' => $faculty,
            'course_content' => $course_content,
            'course' => $course,
            'course_contents' => $course_contents,
        ];

        return view('course_contents.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $u_id university_id 大学id
     * @param  int  $f_id faculty_content_id 学部コンテンツid
     * @param  int  $c_id course_content_id 学科コンテンツid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $u_id, $f_id, $c_id)
    {
        //
        // dd($request->all());
        $this->validate($request, [
            'course_name' => 'required|string',
            'feature' => 'required|string|max:500',
        ]);
        // 各インスタンス取得処理
        $university = University::find($u_id);
        $faculty_content = FacultyContent::find($f_id);
        // 上書き処理
        $course_content = CourseContent::find($c_id);// 学科コンテンツのインスタンスを取得
        $course_content->feature = $request->feature;// 学科コンテンツの feature をリクエストの feature に代入する(*上書き)
        $course_content->save();// 編集内容を保存確定

        return redirect()->back()->with(
            'update_course', $university->name . ' / ' . $faculty_content->faculty->name . 'の' . $request->course_name . ' を編集し確定しました'
        );

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
