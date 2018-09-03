@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">仮会員登録</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.pre_check') }}">
                        {{ csrf_field() }}

{{--                         <div class="form-group　row">
                            <label for="name" class="col-lg-4 col-form-label">Name</label>

                            <div class="col-lg-6">
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="email" class="col-lg-4 col-form-label">メールアドレス</label>

                            <div class="col-lg-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-lg-4 col-form-label">パスワード</label>

                            <div class="col-lg-8">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-lg-4 col-form-label">パスワード(確認用)</label>

                            <div class="col-lg-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-8 offset-lg-4 text-center text-lg-feft">
                                <button type="submit" class="btn btn-primary">
                                    確認画面へ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (session('status'))
                <div class="mt-3">
                    <div class="alert alert-warning">
                        <p>ご入力頂いたメールアドレスは、既に仮登録完了のメールを送信しております。</p>
                        <p >送信日時：{{ session('status') }}</p>
                        <p class="mb-0">お確かめいただき、メールの内容をご確認の上本会員登録を行ってください。</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
