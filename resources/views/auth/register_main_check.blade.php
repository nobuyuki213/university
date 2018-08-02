@extends('layouts.app')

@section()
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">本会員登録確認</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.main.registered') }}">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="name" class="col-lg-4 col-form-label text-lg-right">名前</label>
                            <div class="col-lg-8">
                                <span class="">{{$user->name}}</span>
                                <input type="hidden" name="name" value="{{$user->name}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name_phonetic" class="col-lg-4 col-form-label text-lg-right">フリガナ</label>
                            <div class="col-lg-8">
                                <span class="">{{$user->name_phonetic}}</span>
                                <input type="hidden" name="name_phonetic" value="{{$user->name_phonetic}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birth" class="col-lg-4 col-form-label text-lg-right">生年月日</label>
                            <div class="col-lg-8">
                                <span class="">{{$user->birth_year}}年</span>
                                <input type="hidden" name="birth_year" value="{{$user->birth_year}}">
                                <span class="">{{$user->birth_month}}月</span>
                                <input type="hidden" name="birth_month" value="{{$user->birth_month}}">
                                <span class="">{{$user->birth_day}}日</span>
                                <input type="hidden" name="birth_day" value="{{$user->birth_day}}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-lg-8 offset-lg-4">
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
@endsection()