<?php

namespace App\Admin\Controllers;

use App\Faculty;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FacultyController extends Controller
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

            $content->header('学部名管理');
            $content->description('登録されている学部名の一覧です');

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
            $faculty = Faculty::findOrFail($id);
            $content->header($faculty->name . 'の詳細');
            $content->description('学部名の詳細な情報一覧になります');

            $content->body(Admin::show(Faculty::findOrFail($id), function (Show $show) {

                $show->id();
                // 表示項目の追加
                $show->name('学部名');

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

            $content->header('学部名の編集');
            $content->description('登録されている学部名を編集します');

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

            $content->header('学部名の登録');
            $content->description('新しく学部名を登録します');

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
        return Admin::grid(Faculty::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目の追加
            $grid->name('学部名');
            $grid->facultyContents('学部登録数')->display(function ($facultyContents) {
                $count = count($facultyContents);
                return "<span class='label label-primary'>{$count}</span>";
            });
            $grid->created_at();
            $grid->updated_at();

            // フィルター検索機能の項目を追加
            $grid->filter(function($filter){
                $filter->like('name', '学部名');
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
        return Admin::form(Faculty::class, function (Form $form) {

            $form->display('id', 'ID');
            // 表示項目の追加
            $form->text('name', '学部名')
                ->rules('required|string|unique:faculties|max:191')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
