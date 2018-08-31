@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">本会員登録確認</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.main.registered') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="email_token" value="{{ $email_token }}">
                        <div class="form-group row">
                            <label for="name" class="col-lg-3 col-form-label">名 前</label>
                            <div class="col-lg-9">
                                <span class="">{{$user->name}}</span>
                                <input type="hidden" name="name" value="{{$user->name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_phonetic" class="col-lg-3 col-form-label">フ リ ガ ナ</label>
                            <div class="col-lg-9">
                                <span class="">{{$user->name_phonetic}}</span>
                                <input type="hidden" name="name_phonetic" value="{{$user->name_phonetic}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth" class="col-lg-3 col-form-label">生 年 月 日</label>
                            <div class="col-lg-9">
                                <span class="">{{$user->birth_year}}</span><span class="px-1">年</span>
                                <input type="hidden" name="birth_year" value="{{$user->birth_year}}">
                                <span class="">{{$user->birth_month}}</span><span class="px-1">月</span>
                                <input type="hidden" name="birth_month" value="{{$user->birth_month}}">
                                <span class="">{{$user->birth_day}}</span><span class="px-1">日</span>
                                <input type="hidden" name="birth_day" value="{{$user->birth_day}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="university_id" class="col-lg-3 col-form-label">入学した大学</label>
                            <div class="col-lg-9">
                                <span class="">{{$user->university->name}}</span>
                                <input type="hidden" name="university_id" value="{{$user->university->id}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="admission_year" class="col-lg-3 col-form-label">大学に入学した年度</label>
                            <div class="col-lg-9">
                                <span class="">{{$user->admission_year}}</span><span class="px-1">年度</span>
                                <input type="hidden" name="admission_year" value="{{$user->admission_year}}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-lg-9 offset-lg-3 text-center text-lg-left">
                                <button type="submit" class="btn btn-primary">
                                    本登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection