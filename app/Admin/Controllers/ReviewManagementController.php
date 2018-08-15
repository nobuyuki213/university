<?php

namespace App\Admin\Controllers;

use App\ReviewManagement;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ReviewManagementController extends Controller
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

            $content->header('レビュー操作管理');
            $content->description('レビューを操作管理する一覧です');

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

            $content->header('レビュー操作の詳細');
            $content->description('レビュー操作の詳細な情報一覧になります');

            $content->body(Admin::show(ReviewManagement::findOrFail($id), function (Show $show) {

                $show->id();

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

            $content->header('レビュー操作の編集');
            $content->description('description');

            $content->body($this->form($id)->edit($id));
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

            $content->header('Create');
            $content->description('description');

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
        return Admin::grid(ReviewManagement::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目の追加
            $grid->review_id('レビューID');
            $grid->approved_date('承認された時刻');
            $grid->is_approved('承認済みか')
                ->using([
                    '1' => '<i class="fa fa-check-square-o text-success" aria-hidden="true">済み</i>',
                    '0' => '<span class="text-danger">未承認</span>'
                ])
                ->sortable();
            $grid->approved_admin('承認処理管理者(ID)');
            $grid->points_date('ポイント付与された時刻');
            $grid->points('ポイント数');
            $grid->granted_admin('ポイント付与管理者(ID)');
            $grid->created_at();
            $grid->updated_at();
            // フィルター検索機能の項目を追加
            $grid->filter(function ($filter) {
                // $filter->like('faculty.name', '学部名');
            });
            // 操作パネル非表示設定
            $grid->actions(function ($actions) {
                $actions->disableDelete();
                // $actions->disableEdit();
                // $actions->disableView();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id = null)
    {

        return Admin::form(ReviewManagement::class, function (Form $form) use ($id) {

            $form->tab('承認', function($form) {
                $form->display('id', 'ID');
                // 表示項目の追加
                $form->display('review_id', 'レビューID');
                $form->datetime('approved_date', '承認された日')
                    ->default(now())->attribute('readonly');

                $states = [
                    'on'  => ['value' => 1, 'text' => '承認済み', 'color' => 'success'],
                    'off' => ['value' => 0, 'text' => '未承認', 'color' => 'danger'],
                ];
                $form->switch('is_approved', '承認したか')->states($states);
                $form->text('approved_admin', '承認処理管理者(ID)')
                    ->default(Admin::user()->id)->attribute('readonly');

            })->tab('ポイント', function($form) {
                $form->display('id', 'ID');
                // 表示項目の追加
                $form->display('review_id', 'レビューID');
                $form->datetime('points_date', 'ポイント付与された日')
                    ->default(now())->attribute('readonly');
                $form->number('points', 'ポイント数');
                $form->text('granted_admin', 'ポイント付与管理者(ID)')
                    ->default(Admin::user()->id)->attribute('readonly');

            });



            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
