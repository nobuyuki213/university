@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="header" style="position:relative;">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="position:absolute;top:-3.5rem;right:0.8rem;z-index:3">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="container">
            <h1 class="display-4">メインイメージ</h1>
            {{-- <a class="btn btn-outline-primary btn-lg" href="#" role="button">test</a> --}}
        </div>
    </div>
</div>
<div class="container">
    <div class="main-contents row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <a href="{{ route('schools') }}">
                    <figure class="mb-0">
                        <h5 class="text-center text-white px-3 py-3 mb-0 w-70">School work</h5>
                        <img src="{{ asset('storage/student.jpg') }}" class="card-img img-fluid" style="height:230px;object-fit:cover;object-position: 50% 0" />
                        <figcaption class="text-center">
                            <div class="card-body">
                                <h3 class="text-white">学業</h3>
                                <p class="text-white">School work</p>
                            </div>
                        </figcaption>
                    </figure>
                </a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <a href="#">
                    <figure class="mb-0">
                        <h5 class="text-center text-white px-3 py-3 mb-0 w-70">Coming soon</h5>
                        <img src="{{ asset('storage/work.jpg') }}" class="card-img img-fluid" style="height:230px;object-fit:cover;object-position: 50% 0" />
                        <figcaption class="text-center">
                            <div class="card-body">
                                <h3 class="text-white">Coming soon</h3>
                                {{-- <p class="text-white">Work</p> --}}
                            </div>
                        </figcaption>
                    </figure>
                </a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <a href="#">
                    <figure class="mb-0">
                        <h5 class="text-center text-white px-3 py-3 mb-0 w-70">Coming soon</h5>
                        <img src="{{ asset('storage/work.jpg') }}" class="card-img img-fluid" style="height:230px;object-fit:cover;object-position: 50% 0" />
                        <figcaption class="text-center">
                            <div class="card-body">
                                <h3 class="text-white">Coming soon</h3>
                                {{-- <p class="text-white">Entertainment</p> --}}
                            </div>
                        </figcaption>
                    </figure>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- 確認用 --}}
<div class="jumbotron jumbotron-fliud bg-primary rounded-0 my-5">
    <div class="container">
        <div class="about card my-5 rounded-0 border-0">
            <div class="card-header rounded-0">
                <h3 class="mb-0 py-3 text-center font-weight-bold">about</h3>
            </div>
            <div class="card-body">
                <div class="test-account">
                    <p>本アプリケーションは、一部ログインを必要とします。メールアドレス等で新規ユーザーご登録いただくか、以下のサンプルをご利用ください。</p>
                    <div class="table-responsive text-nowrap">
                        <table class="table w-auto">
                            <thead>
                                <tr>
                                    <th colspan="2" scope="col" class="text-center table-info">ログイン用サンプルアカウント</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">メールアドレス</th>
                                    <td>boy@test.com</td>
                                </tr>
                                <tr>
                                    <th scope="row">パスワード</th>
                                    <td>boy0000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table w-auto">
                            <thead>
                                <tr>
                                    <th colspan="2" scope="col" class="text-center table-info">adminログイン用サンプルアカウント</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">ユーザーID</th>
                                    <td>admin</td>
                                </tr>
                                <tr>
                                    <th scope="row">パスワード</th>
                                    <td>admin</td>
                                </tr>
                                <tr>
                                    <th scope="row">URL</th>
                                    <td><a href="http://university/admin/auth/login" title="admin">adminログインページ</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="">
                    <h5 class="border-primary border-bottom border-top py-2">■ 実装内容</h5>
                    <ul>
                        <li>大学授業の検索機能及び絞り込み機能</li>
                        <li>ログイン機能</li>
                        <li>admin管理機能</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()