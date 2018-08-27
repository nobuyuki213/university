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
                <a href="{{ route('school') }}">
                    <figure class="mb-0">
                        <h5 class="text-center text-white px-3 py-3 mb-0 w-70">School work</h5>
                        <img src="{{ asset('storage/student.jpg') }}" class="card-img img-fluid" style="height:230px;object-fit:none;object-position: 50% 0" />
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
                        <img src="{{ asset('storage/work.jpg') }}" class="card-img img-fluid" style="height:230px;object-fit:none;object-position: 50% 0" />
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
                <img class="card-img-top" src="" alt="カード画像のキャプション">
                <div class="card-body">
                    <h3 class="text-center p-5">遊ぶ</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()