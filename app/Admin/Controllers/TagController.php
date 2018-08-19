<?php

namespace App\Admin\Controllers;

use App\Tag;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TagController extends Controller
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

            $content->header('タグの管理');
            $content->description('登録されているタグの一覧です');

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

            $content->header('タグの詳細');
            $content->description('タグの詳細な情報一覧になります');

            $content->body(Admin::show(Tag::findOrFail($id), function (Show $show) {

                $show->id();
                // 表示項目の追加
                $show->name('タグ名');

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

            $content->header('タグの編集');
            $content->description('登録されているタグを編集します');

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

            $content->header('タグの登録');
            $content->description('新しくタグを登録します');

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
        return Admin::grid(Tag::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目の追加
            $grid->name('タグ名');
            $grid->lessons('タグ利用数')->display(function ($lessons) {
                return count($lessons);
            })->label('primary');

            $grid->created_at();
            $grid->updated_at();
            // フィルター検索機能の項目を追加
            $grid->filter(function($filter){
                $filter->like('name', 'タグ名');
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
        return Admin::form(Tag::class, function (Form $form) {

            $form->display('id', 'ID');
            // 表示項目の追加
            $form->text('name', 'タグ名')
                ->rules('required|string|max:191')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
