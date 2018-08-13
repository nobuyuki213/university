<?php

namespace App\Admin\Controllers;

use App\CourseContent;
use App\FacultyContent;
use App\Course;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CourseContentController extends Controller
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

            $content->header('学科管理');
            $content->description('登録されている学科の一覧です');

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
            $course = CourseContent::findOrFail($id)->course;
            $content->header($course->name . 'の詳細');
            $content->description('学科の詳細な情報一覧になります');

            $content->body(Admin::show(CourseContent::findOrFail($id), function (Show $show) {

                $show->id();
                // 表示項目の追加
                $show->course_id('学科名ID');
                $show->course()->name('学科名');
                $show->feature('学科の説明');

                $show->facultycontent('学科が所属する[学部][大学]の詳細', function ($facultycontent) {
                    $facultycontent->setResource('/admin/auth/facultycontent');
                    // 表示項目の追加
                    $facultycontent->id('学部ID');
                    $facultycontent->overview('学部の説明');
                    $facultycontent->faculty()->id('学部名ID');
                    $facultycontent->faculty()->name('学部名');
                    $facultycontent->divider();
                    $facultycontent->university()->id('大学ID');
                    $facultycontent->university()->name('大学名');
                    $facultycontent->university()->description('大学の説明');

                    // 操作パネル非表示設定
                    $facultycontent->panel()
                        ->tools(function ($tools) {
                            $tools->disableEdit();
                            $tools->disableList();
                            $tools->disableDelete();
                        });
                });

                // $show->facultycontent()->university()->name('大学名');

                $show->created_at();
                $show->updated_at();
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

            $content->header('学科の編集');
            $content->description('登録されている学科を編集します');

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

            $content->header('学科の登録');
            $content->description('新しく学科を登録します');

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
        return Admin::grid(CourseContent::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目の追加
            $grid->column('course_id', '学科名ID');
            $grid->column('course.name', '学科名');
            $grid->column('faculty_content_id', '学部ID');
            $grid->facultycontent('学部名')->display(function ($facultycontent) {
                return FacultyContent::find($facultycontent['id'])->faculty->name;
            });
            // $grid->created_at();作成日時非表示
            // $grid->updated_at();更新日時非表示

            // フィルター検索機能の項目を追加
            $grid->filter(function ($filter) {
                $filter->like('course.name', '学科名');
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(CourseContent::class, function (Form $form) {

            $form->display('id', 'ID');
            // 表示項目の追加
            $form->select('course_id', '学科名(ID)')->options(Course::pluck('name','id'))
                ->rules('required|integer')
                // ->attribute(['class' => 'input-lg']) クラス属性が反映できない
                ->attribute('required');

            $form->textarea('feature', '学科の説明')
                ->rules('required|string|max:500')
                ->attribute(['class' => 'form-control'])
                ->attribute('required');

            $form->select('faculty_content_id', '学部(ID)')
                ->options(array_pluck(FacultyContent::with('faculty')->get(), 'faculty.name', 'id'))
                ->rules('required|integer')
                // ->attribute(['class' => 'input-lg']) クラス属性が反映できない
                ->attribute('required')
                ->help('学科が属する学部名を選択してください');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
