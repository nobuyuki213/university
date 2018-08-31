@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">本会員登録完了</div>

                    <div class="card-body text-center">
                        <p>本会員登録が完了しました。</p>
                        <a href="{{ env('APP_URL') }}" class="btn btn-primary">TOPページへ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection