<?php

namespace App\Admin\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CourseController extends Controller
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

            $content->header('学科名管理');
            $content->description('登録されている学科名の一覧です');

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
            $course = Course::findOrFail($id);
            $content->header($course->name . 'の詳細');
            $content->description('学科名の詳細な情報一覧になります');

            $content->body(Admin::show(Course::findOrFail($id), function (Show $show) {

                $show->id();
                // 表示項目の追加
                $show->name('学科名');

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

            $content->header('学科名の編集');
            $content->description('登録されている学科名を編集します');

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

            $content->header('学科名の登録');
            $content->description('新しく学科名を登録します');

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
        return Admin::grid(Course::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目の追加
            $grid->name('学科名');
            $grid->courseContents('学科登録数')->display(function ($courseContents) {
                $count = count($courseContents);
                return "<span class='label label-primary'>{$count}</span>";
            });
            $grid->created_at();
            $grid->updated_at();

            // フィルター検索機能の項目を追加
            $grid->filter(function($filter){
                $filter->like('name', '学科名');
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
        return Admin::form(Course::class, function (Form $form) {

            $form->display('id', 'ID');
            // 表示項目の追加
            $form->text('name', '学科名')
                ->rules('required|string|unique:courses|max:191')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
