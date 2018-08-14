<?php

namespace App\Admin\Controllers;

use App\Review;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ReviewController extends Controller
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

            $content->header('大学レビュー');
            $content->description('登録されている大学のレビュー一覧です');

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

            $content->header('レビューの詳細');
            $content->description('大学レビューの詳細な情報一覧になります');

            $content->body(Admin::show(Review::findOrFail($id), function (Show $show) {

                $show->id();
                // 表示項目の追加
                $show->user_id('UserID');
                $show->user()->name('投稿者名');
                $show->title('タイトル');
                $show->body('総合評価レビュー');
                $show->rating('評価点(平均)');

                $show->created_at();
                $show->updated_at();
                // レビュー先の大学詳細
                $show->universities('レビュー先の大学詳細', function ($univer) {
                    $univer->resource('admin/auth/university');
                    // 表示項目の追加
                    $univer->university_id('大学ID');
                    $univer->name('大学名');
                    $univer->faculty('学部名');
                    $univer->course('学科名');
                    $univer->address('住所');
                    $univer->phone_number('電話番号');
                    $univer->url('公式サイト');
                    // 操作パネル非表示設定
                    $univer->actions(function ($actions) {
                        $actions->disableDelete();
                    });
                    $univer->disableCreateButton();
                    $univer->disableRowSelector();
                });
                //レビューユーザー詳細
                $show->user('レビューユーザー詳細', function ($user) {
                    $user->setResource('/admin/auth/user');
                    // 表示項目の追加
                    $user->id('userID');
                    $user->name('氏名');
                    $user->name_phonetic('フリガナ');
                    $user->birth_year('誕生年');
                    $user->birth_month('誕生月');
                    $user->birth_day('誕生日');
                    $user->avatar('アバター');
                    $user->email('メールアドレス');
                    $user->created_at();
                    $user->updated_at();
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

            $content->header('大学レビューの編集');
            $content->description('投稿された大学のレビューを編集します');

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
        return Admin::grid(Review::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目の追加
            $grid->user_id('UserID');
            $grid->user()->name('投稿者名');
            $grid->title('タイトル');
            // $grid->body('総合評価レビュー')->display(function ($body) {
            //     return str_limit($body, 20, '.');
            // });
            $grid->rating('評価点(平均)')->display(function ($rating) {
                return $rating;
            })->label('info');
            $grid->universities('投稿先大学名')->display(function ($universities) {
                $universities = array_map(function ($university) {
                    return $university['name'];
                }, $universities);
                return join('&nbsp;', $universities);
            })->label('success');

            $grid->created_at();
            $grid->updated_at();
            // フィルター検索機能の項目を追加
            $grid->filter(function($filter){
                $filter->like('user.name', '氏名');
                $filter->between('created_at', '作成時刻')->datetime();
                // $filter->like('email', 'メールアドレス');
            });
            // 操作パネル非表示設定
            $grid->disableCreateButton();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
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
        return Admin::form(Review::class, function (Form $form) {

            $form->display('id', 'ID');
            // 表示項目の追加
            $form->display('user_id', 'UserID');
            $form->display('user.name', '投稿者名');
            $form->display('title', 'タイトル');
            $form->display('body', '総合評価レビュー');
            $form->display('rating', '評価点(平均)');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');

        });
    }
}
