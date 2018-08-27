@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">パスワードをお忘れですか？</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>
                    @else
                        <div class="infomaition p-2">
                            <p>パスワードをリセットします</p>
                            <p>登録しているメールアドレスを入力してください</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

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

                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    パスワード再設定用メール送信
                                </button>
                            </div>
                            <div class="text-center text-primary mt-2">
                                上記メールアドレスに再設定用のURLを送信します
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
