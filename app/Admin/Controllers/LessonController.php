<?php

namespace App\Admin\Controllers;

use App\Lesson;
use App\University;
use App\Faculty;
use App\Course;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class LessonController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('授業管理');
            $content->description('登録されている授業の一覧です');

            $content->body($this->grid());
        });
    }

    /**
     * Show interface.
     *
     * @param $id
     * @return Content
     */
    public function show($id)
    {
        return Admin::content(function (Content $content) use ($id) {
            $lesson = Lesson::findOrFail($id);
            $content->header($lesson->name . 'の詳細');
            $content->description('授業の詳細な情報一覧になります');

            $content->body(Admin::show(Lesson::findOrFail($id), function (Show $show) use ($lesson) {

                $show->id();
                // 表示項目の追加
                $show->name('授業名');

                $show->created_at();
                $show->updated_at();

                $show->university('【' . $lesson->name . '】が所属する大学', function ($univer) {
                    $univer->setResource('/admin/auth/university');
                    // 表示項目の追加
                    $univer->id('大学ID');
                    $univer->name('大学名');
                    // 操作パネルの非表示設定
                    $univer->panel()
                        ->tools(function ($tools) {
                            $tools->disableDelete();
                        });
                });

                $show->faculty('【' . $lesson->name . '】が所属する学部名', function ($faculty) {
                    $faculty->setResource('/admin/auth/faculty');
                    // 表示項目の追加
                    $faculty->id('学部名ID');
                    $faculty->name('学部名');
                    // 操作パネルの非表示設定
                    $faculty->panel()
                        ->tools(function ($tools) {
                            $tools->disableDelete();
                        });
                });

                $show->course('【' . $lesson->name . '】が所属する学科名', function ($course) {
                    $course->setResource('/admin/auth/course');
                    // 表示項目の追加
                    $course->id('学科名ID');
                    $course->name('学科名');
                    // 操作パネルの非表示設定
                    $course->panel()
                        ->tools(function ($tools) {
                            $tools->disableDelete();
                        });
                });

            }));
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('授業の編集');
            $content->description('登録されている授業を編集します');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('授業の登録');
            $content->description('新しく授業を登録します');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Lesson::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目の追加
            $grid->name('授業名');
            $grid->university()->name('大学名');
            $grid->faculty()->name('学部名');
            $grid->course()->name('学科名');

            $grid->created_at();
            $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Lesson::class, function (Form $form) {

            $form->display('id', 'ID');
            // 表示項目の追加
            $form->select('university_id', '大学(ID)')->options(University::pluck('name', 'id'))
                ->rules('required|integer')
                ->attribute('required');
            $form->select('faculty_id', '学部名(ID)')->options(Faculty::pluck('name', 'id'))
                ->rules('required|integer')
                ->attribute('required');
            $form->select('course_id', '学科名(ID)')->options(Course::pluck('name', 'id'))
                ->rules('required|integer')
                ->attribute('required');
            $form->text('name', '授業名')
                ->rules('required|string|max:50')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required');
            $school_year = [1 => '1学年', 2 => '2学年', 3 => '3学年', 4 => '4学年',];
            $form->select('school_year', '学年')->options($school_year);
            $form->text('teacher_name', '先生名')
                ->rules('required|string|max:20')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required')
                ->help('（記入例）山田 太郎');
            $form->text('textbook_name', '教科書名')
                ->rules('required|string|max:20')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required');
            $form->divide();

            $states = [
                'on'  => ['value' => 1, 'text' => 'ある', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'ない', 'color' => 'danger'],
            ];
            $level = [1 => 'とても簡単', 2 => '簡単', 3 => '普通', 4 => '難しい', 5 => 'とても難しい',];

            $form->switch('is_intermediate_test', '中間テストがあるか？')->states($states);
            $form->radio('intermediate_level', '中間テストの難易度')->options($level);
            $form->switch('is_intermediate_report', '中間レポートがあるか？')->states($states);
            $form->divide();

            $form->switch('is_final_test', '期末テストがあるか？')->states($states);
            $form->radio('final_level', '期末テストの難易度')->options($level);
            $form->switch('is_final_report', '期末レポートがあるか？')->states($states);
            $form->divide();

            $attend = ['取らない' => '取らない', '時々取る' => '時々取る', 'ほぼ毎回取る' => 'ほぼ毎回取る', '取る' => '取る',];
            $form->radio('attend', '出席')->options($attend);
            $form->text('attendance_method', '出席方法')
                ->rules('required|string|max:50')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required');
            $form->textarea('test_range', 'テスト範囲(出題傾向)')
                ->rules('required|string|max:700')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required');
            $form->textarea('remarks', '備考')
                ->rules('string|max:500')
                ->attribute(['class' => 'form-control input-lg']);

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
