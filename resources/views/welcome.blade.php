@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">メインイメージ</h1>
        {{-- <a class="btn btn-outline-primary btn-lg" href="#" role="button">test</a> --}}
    </div>
</div>
<div class="container">
    <div class="main-contents row">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="" alt="カード画像のキャプション">
                <a href="{{ route('school') }}">
                    <div class="card-body">
                        <P class="h3 text-center p-5">学業</p>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="" alt="カード画像のキャプション">
                <div class="card-body">
                    <a href=""><h3 class="text-center p-5">働く</h3></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img class="card-img-top" src="" alt="カード画像のキャプション">
                <div class="card-body">
                    <h3 class="text-center p-5">遊ぶ</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()