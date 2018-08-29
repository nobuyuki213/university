<?php

namespace App\Admin\Controllers;

use App\Senior;
use App\Lesson;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class SeniorController extends Controller
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

            $content->header('先輩(コメント)管理');
            $content->description('登録されている先輩(コメント)の一覧です');

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

            $content->header('先輩(コメント)の詳細');
            $content->description('先輩(コメント)の詳細な情報一覧になります');

            $content->body(Admin::show(Senior::findOrFail($id), function (Show $show) {

                $show->id();
                // 表示項目の追加
                $show->lesson_id('授業ID');
                $show->comment('先輩のコメント');

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

            $content->header('先輩の編集');
            $content->description('登録されている先輩を編集します');

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

            $content->header('先輩(コメント)の登録');
            $content->description('新しく先輩(コメント)を登録します');

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
        return Admin::grid(Senior::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目の追加
            $grid->lesson_id('授業ID');
            $grid->comment('先輩のコメント')->limit(50);
            $grid->created_at();
            $grid->updated_at();
            // 操作パネルの非表示設定
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                $actions->disableEdit();
            });
            $grid->disableCreateButton();
            $grid->disableRowSelector();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Senior::class, function (Form $form) {

            $form->display('id', 'ID');
            // 表示項目の追加

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
