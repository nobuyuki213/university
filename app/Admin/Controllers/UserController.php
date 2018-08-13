<?php

namespace App\Admin\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UserController extends Controller
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

            $content->header('ユーザー管理'); //初期値:Index
            $content->description('登録されているユーザーの一覧です'); //初期値:description

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
            $user = User::findOrFail($id);
            $content->header($user->name . 'さんの詳細');
            $content->description($user->name . 'さんの詳細な情報一覧です');

            $content->body(Admin::show(User::findOrFail($id), function (Show $show) use ($user) {

                $show->id();
                // 表示項目の追加
                $show->name('名前');
                $show->name_phonetic('フリガナ');
                $show->birth_year('誕生年');
                $show->birth_month('誕生月');
                $show->birth_day('誕生日');
                $show->avatar('アバター');
                $show->email('メールアドレス');
                $show->email_verified('メールアドレス認証確認');
                $show->status('本登録済み確認');
                // ユーザーレビュー情報の追加
                $show->reviews($user->name . 'さんのレビュー一覧', function($reviews) {
                    $reviews->id('ID');
                    $reviews->title('タイトル');
                });

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

            $content->header('Edit');
            $content->description('description');

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
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目を追加
            $grid->column('name', '氏名');
            $grid->column('email', 'メールアドレス');

            $grid->created_at();
            $grid->updated_at();

            // フィルター検索機能の項目を追加
            $grid->filter(function($filter){
                $filter->like('name', '氏名');
                $filter->like('email', 'メールアドレス');
            });
            // ソースデータの並び順の初期設定
            $grid->model()->orderBy('id', 'desc');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
