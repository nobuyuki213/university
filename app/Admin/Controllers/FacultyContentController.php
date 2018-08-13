<?php

namespace App\Admin\Controllers;

use App\FacultyContent;
use App\CourseContent;
use App\University;
use App\Faculty;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class FacultyContentController extends Controller
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

            $content->header('学部管理');
            $content->description('登録されている学部の一覧です');

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
            $faculty = FacultyContent::findOrFail($id)->faculty;
            $content->header($faculty->name . 'の詳細');
            $content->description('学部の詳細な情報一覧になります');

            $content->body(Admin::show(FacultyContent::findOrFail($id), function (Show $show) {

                $show->id();
                // 表示項目の追加
                $show->faculty_id('学部名ID');
                $show->faculty()->name('学部名');
                $show->overview('学部の説明');
                $show->university_id('大学ID');
                $show->university()->name('大学名');

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

            $content->header('学部の編集');
            $content->description('登録されている学部を編集します');

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

            $content->header('学部の登録');
            $content->description('新しく学部を登録します');

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
        return Admin::grid(FacultyContent::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目の追加
            $grid->column('faculty_id', '学部名ID');
            $grid->column('faculty.name', '学部名');
            $grid->column('university_id', '大学ID');
            $grid->column('university.name', '大学名');
            $grid->courseContents('学科登録数')->display(function ($courseContents) {
                $count = count($courseContents);
                return "<span class='label label-primary'>{$count}</span>";
            });
            // $grid->created_at();作成日時非表示
            // $grid->updated_at();更新日時非表示

            // フィルター検索機能の項目を追加
            $grid->filter(function ($filter) {
                $filter->like('faculty.name', '学部名');
                $filter->like('university.name', '大学名');
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
        return Admin::form(FacultyContent::class, function (Form $form) {

            $form->display('id', 'ID');
            // 表示項目の追加
            $form->select('faculty_id', '学部名(ID)')->options(Faculty::pluck('name','id'))
                ->rules('required|integer')
                // ->attribute(['class' => 'input-lg']) クラス属性が反映できない
                ->attribute('required');

            $form->textarea('overview', '学部の説明')
                ->rules('required|string|max:500')
                ->attribute(['class' => 'form-control'])
                ->attribute('required');

            $form->select('university_id', '大学名(ID)')->options(University::pluck('name','id'))
                ->rules('required|integer')
                // ->attribute(['class' => 'input-lg']) クラス属性が反映できない
                ->attribute('required')
                ->help('学部が属する大学名を選択してください');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
