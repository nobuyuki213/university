@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">本会員登録</div>

                @isset($message)
                    <div class="card-body">
                        {{$message}}
                    </div>
                @endisset

                @empty($message)
                    <div class="card-body">
                        <form method="POST" action="{{ route('register.main.check') }}" name="change-day" id="change-day">
                            {{ csrf_field() }}

                            <input type="hidden" name="email_token" value="{{ $email_token }}">

                            <div class="form-group row">
                                <label for="name" class="col-lg-3 col-form-label">氏 名</label>
                                <div class="col-lg-9">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" area-describedby="nameHelpBlock" required>
                                    <small id="nameHelpBlock" class="form-text text-muted">氏名は、名字(姓)と名前(名)の間に半角スペースを入れて入力してください。（入力例：大学 一郎）</small>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name_phonetic" class="col-lg-3 col-form-label">フ リ ガ ナ</label>

                                <div class="col-lg-9">
                                    <input id="name_phonetic" type="text" class="form-control{{ $errors->has('name_phonetic') ? ' is-invalid' : '' }}" name="name_phonetic" value="{{ old('name_phonetic') }}" area-describedby="namePhoneticHelpBlock" required>
                                    <small id="namePhoneticHelpBlock" class="form-text text-muted">フリガナは、全角カナで名字(姓)と名前(名)の間に半角スペースを入れて入力してください。（入力例：ダイガク イチロウ）</small>

                                    @if ($errors->has('name_phonetic'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name_phonetic') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birth_year" class="col-xl-3 col-form-label">生 年 月 日</label>
                                <div class="col-xl-9">
                                    <div class="row">
                                        <div class="input-group col-xl-4 pr-xl-0">
                                            <select id="birth_year" class="custom-select{{ $errors->has('birth_year') ? ' is-invalid' : '' }}" name="birth_year" required>
                                                {{-- <option value="">----</option> --}}
                                                @for ($i = now()->Subyear(35)->format('Y'); $i <= now()->Subyear(15)->format('Y'); $i++)
                                                    <option value="{{ $i }}" @if(old('birth_year') == $i) selected @endif>{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <div class="input-group-append">
                                            	<label class="input-group-text" for="birth_year">年</label>
                                            </div>
                                            @if ($errors->has('birth_year'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('birth_year') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="input-group col-xl-4 py-xl-0 py-2">
                                            <select id="birth_month" class="custom-select{{ $errors->has('birth_month') ? ' is-invalid' : '' }}" name="birth_month" required>
                                                {{-- <option value="">--</option> --}}
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}" @if(old('birth_month') == $i) selected @endif>{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <div class="input-group-append">
                                            	<label class="input-group-text" for="birth_month">月</label>
                                            </div>
                                            @if ($errors->has('birth_month'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('birth_month') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="input-group col-xl-4 pl-xl-0">
                                            <select id="birth_day" class="custom-select{{ $errors->has('birth_day') ? ' is-invalid' : '' }}" name="birth_day" required>
                                                {{-- <option value="">--</option> --}}
                                                @for ($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}" @if(old('birth_day') == $i) selected @endif>{{ $i }}</option>
                                                @endfor
                                            </select>
                                            <div class="input-group-append">
                                            	<label class="input-group-text" for="birth_day">日</label>
                                            </div>
                                            @if ($errors->has('birth_day'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('birth_day') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>
	                        </div>

                            <div class="form-group row">
                                <label for="university" class="col-lg-3 col-form-label">入学した大学</label>

                                <div class="col-lg-9">
                                    <select id="university" class="custom-select custom-select-lg{{ $errors->has('university') ? ' is-invalid' : '' }}" name="university" required>
                                        <option value="">----</option>
                                        @foreach ($universities as $univer)
                                            <option value="{{ $univer->id }}" @if (old('university') == $univer->id) selected @endif>{{ $univer->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('university'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('university') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="admission_year" class="col-lg-3 col-form-label">大学に入学した年度</label>

                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <select id="admission_year" class="custom-select{{ $errors->has('admission_year') ? ' is-invalid' : '' }}" name="admission_year" required>
                                            <option value="">----</option>
                                            @for ($i = now()->Subyear(20)->format('Y'); $i <= now()->format('Y'); $i++)
                                                <option value="{{ $i }}" @if(old('admission_year') == $i) selected @endif>{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="admission_year">年</label>
                                        </div>
                                        @if ($errors->has('admission_year'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('admission_year') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

	                        <div class="form-group row mb-0">
	                            <div class="col-lg-9 offset-lg-3 text-center text-lg-left">
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
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/birthday.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/birthday.min.js') }}"></script>
@endsection