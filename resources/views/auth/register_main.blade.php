@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">本会員登録</div>

                @isset($message)
                    <div class="card-body">
                        {{$message}}
                    </div>
                @endisset

                @empty($message)
                    <div class="card-body">
                        <form method="POST" action="{{ route('register.main.check') }}">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="name" class="col-lg-4 col-form-label text-lg-right">名前</label>
                                <div class="col-lg-8">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name_phonetic" class="col-lg-4 col-form-label text-lg-right">フリガナ</label>

                                <div class="col-lg-8">
                                    <input id="name_phonetic" type="text" class="form-control{{ $errors->has('name_phonetic') ? ' is-invalid' : '' }}" name="name_phonetic" value="{{ old('name_phonetic') }}" required>

                                    @if ($errors->has('name_phonetic'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name_phonetic') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birth_year" class="col-lg-4 col-form-label text-lg-right">生年月日</label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <select id="birth_year" class="form-control{{ $errors->has('birth_year') ? ' is-invalid' : '' }}" name="birth_year" required>
                                                <option value="">----</option>
                                                @for ($i = 1980; $i <= 2005; $i++)
                                                    <option value="{{ $i }}" @if(old('birth_year') == $i) selected @endif>{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @if ($errors->has('birth_year'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('birth_year') }}</strong>
                                                </span>
                                            @endif
                                        </div>年

                                        <div class="col-lg-3">
                                            <select id="birth_month" class="form-control{{ $errors->has('birth_month') ? ' is-invalid' : '' }}" name="birth_month" required>
                                                <option value="">--</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}" @if(old('birth_month') == $i) selected @endif>{{ $i }}</option>
                                                @endfor
                                            </select>
                                            @if ($errors->has('birth_month'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('birth_month') }}</strong>
                                                </span>
                                            @endif
                                        </div>月

                                        <div class="col-lg-3">
                                            <select id="birth_day" class="form-control{{ $errors->has('birth_day') ? ' is-invalid' : '' }}" name="birth_day" required>
                                                <option value="">--</option>
                                                @for ($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}" @if(old('birth_day') == $i) selected @endif>{{ $i }}</option>
                                                @endfor
                                            </select>

                                            @if ($errors->has('birth_day'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('birth_day') }}</strong>
                                                </span>
                                            @endif
                                        </div>日
                                    </div>

                                </div>
	                        </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-lg-8 offset-lg-4">
	                                <button type="submit" class="btn btn-primary">
	                                    確認画面へ
	                                </button>
	                            </div>
	                        </div>
                        </form>
	                </div>
                @endempty
            </div>
        </div>
    </div>
@endsection()