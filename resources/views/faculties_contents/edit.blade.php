@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid bg-warning">
    <div class="container">
        <h1 class="display-4 text-center">学部編集</h1>
    </div>
</div>
<div class="container">
{{-- エラーチェック テスト --}}
{{-- <pre>
	@foreach ($errors->all() as $error){{ $error }}@endforeach
</pre> --}}

	@if (Session::has('update_faculty'))
		<div class="alert alert-warning text-center">
			<p class="d-inline-block">{{ session('update_faculty') }}</p>
			<span class="btn btn-success ml-lg-3 d-lg-inline-block d-block">設定画面に戻る</span>
		</div>
	@endif

	<div class="universtity-faculty-edit">

				<div class="select-university">
			のちにここに大学を選択して切り替えできるセレクトボックスの設置予定
		</div>
		<div class="setting-faculties">
			<div class="row">
				<div class="set-faculty col-lg-3">
					<div class="card border-info mt-3">
						<div class="card-header bg-info text-white text-center">
							<span class="">登録済学部</span>
						</div>
						<div class="card-body">
						@foreach ($faculty_contents as $key => $faculty_content)
						<div class="registered-faculty clearfix">
							<div class="float-right pt-1">
								{!! Form::open(['route' => ['edit.faculty', $university->id], 'method' => 'get', 'name' => "form_faculty{$key}"]) !!}
								<input type="hidden" name="faculty" value="{{$faculty_content->faculty->id}}">
								{!! Form::close() !!}
								<a href="javascript:form_faculty{{$key}}.submit()"><i class="far fa-edit"></i></a>
							</div>
							<div class="mb-2 px-3 py-1 border-left border-info">
								{{ $faculty_content->faculty->name }}
							</div>
						</div>
						@endforeach
						</div>
					</div>
				</div>
				<div class="edit-faculty col">
					<div class="card my-3">
						<div class="card-header">
							<span class="d-inline-block">学部を編集する大学名：</span><h4 class="d-inline-block mb-0">{{ $university->name }}</h4>
						</div>
						<div class="card-body">

							<div class="selected-faculty">
							{!! Form::open(['route' => ['update.faculty', $university->id], 'method' => 'put']) !!}
								<div class="form-group row">
									{!! Form::label('faculty_name', '編集する学部名', ['class' => 'col col-form-label my-auto']) !!}
									<div class="col-lg-10">
										<input type="hidden" name="faculty_id" value="{{ $faculty->id }}">
										{!! Form::text('faculty_name', $faculty->name, ['class' => 'form-control-plaintext', 'readonly']) !!}
									</div>
								</div>
								<div class="form-group row">
									{!! Form::label('overview', '編集する学部の説明', ['class' => 'col col-form-label my-auto']) !!}
									<div class="col-lg-10">
										<input type="hidden" name="facultyContent" value="{{ $f_content->id }}">
										{!! Form::textarea('overview', $f_content->overview, ['class' => $errors->has('overview') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
										<div class="invalid-feedback">{{ $errors->first('overview') }}</div>
									</div>
								</div>
								<div class="submit-form text-center">
									{!! Form::button('入力内容で編集を確定する', ['class' => 'btn btn-outline-warning', 'type' => 'submit']) !!}
								</div>
							</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>


@endsection