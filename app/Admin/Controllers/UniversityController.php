<?php

namespace App\Admin\Controllers;

use App\University;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class UniversityController extends Controller
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

            $content->header('大学管理');
            $content->description('登録されている大学の一覧です');

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
            $univer = University::findOrFail($id);
            $content->header($univer->name . 'の詳細');// 初期値:Detail
            $content->description('大学の詳細な情報一覧になります');

            $content->body(Admin::show(University::findOrFail($id), function (Show $show) use ($univer) {

                $show->id();
                // 表示項目の追加
                $show->name('大学名');
                $show->description('大学の説明');
                $show->address('住所');
                $show->phone_number('電話番号');
                $show->url('公式サイト');
                $show->created_at();
                $show->updated_at();

                $show->facultycontents($univer->name . 'に所属する学部', function ($facultycontents) {
                    // 表示項目の追加
                    $facultycontents->faculty()->id('学部名ID');
                    $facultycontents->faculty()->name('学部名');
                    $facultycontents->id('学部ID');
                    $facultycontents->overview('学部説明')->limit(30);
                    $facultycontents->created_at();
                    $facultycontents->updated_at();

                    // 操作パネル非表示設定
                    $facultycontents->disableCreateButton();
                    $facultycontents->disableRowSelector();
                    $facultycontents->disableActions();
                });

                $show->coursecontents($univer->name . 'に所属する学科', function ($coursecontents) {
                    // 表示項目の追加
                    $coursecontents->course()->id('学科名ID');
                    $coursecontents->course()->name('学科名');
                    $coursecontents->id('学科ID');
                    $coursecontents->feature('学科説明')->limit(30);
                    $coursecontents->created_at();
                    $coursecontents->updated_at();

                    // 操作パネル非表示設定
                    $coursecontents->disableCreateButton();
                    $coursecontents->disableRowSelector();
                    $coursecontents->disableActions();
                });

                $show->users($univer->name . 'に入学したユーザー', function ($users) {
                    // 表示項目の追加
                    $users->id('ユーザーID');
                    $users->name('氏名');
                    $users->name_phonetic('氏名（フリガナ）');
                    $users->admission_year('入学年度');
                    $users->created_at();
                    $users->updated_at();
                    // フィルター検索機能の項目を追加
                    $users->filter(function ($filter) {
                        $filter->like('name', '氏名');
                    });
                    // 操作パネル非表示設定
                    $users->disableCreateButton();
                    $users->disableRowSelector();
                    $users->disableActions();
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

            $content->header('大学の編集');
            $content->description('登録されている大学を編集します');

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

            $content->header('大学の登録');
            $content->description('新しく大学を登録します');

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
        return Admin::grid(University::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            // 表示項目を追加
            $grid->name('大学名');
            $grid->address('住所');
            $grid->phone_number('電話番号');
            $grid->url('公式サイト');
            $grid->facultycontents('学部')->display(function ($facultyContents) {
                $count = count($facultyContents);
                return "<span class='label label-primary'>{$count}</span>";
            });
            // $grid->created_at();作成日時非表示
            // $grid->updated_at();更新日時非表示

            // フィルター検索機能の項目を追加
            $grid->filter(function($filter){
                $filter->like('name', '大学名');
                $filter->like('address', '住所');
                $filter->like('phone_number', '電話番号');
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
        return Admin::form(University::class, function (Form $form) {

            $form->display('id', 'ID');
            // 表示項目の追加
            $form->text('name', '大学名')
                ->rules('required|string|max:191')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required');

            $form->textarea('description', '大学の説明')
                ->rules('required|string|max:500')
                ->attribute(['class' => 'form-control', 'style' => 'font-size:1.8rem'])
                ->attribute('required');

            $form->text('address', '住所')
                ->rules('required|string|max:191')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required')
                ->help('（入力例）広島県東広島市黒瀬学園台555-36');

            $form->mobile('phone_number', '電話番号')
                ->rules('required|regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required')
                ->help('（入力例1）000-0000-0000 （入力例2）0000-00-0000');

            $form->url('url', '公式サイト')
                ->rules('required|string|url|max:191')
                ->attribute(['class' => 'form-control input-lg'])
                ->attribute('required')
                ->help('（入力例）http://www.hirokoku-u.ac.jp');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
