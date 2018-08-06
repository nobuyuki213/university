@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4 text-center">学部設定</h1>
    </div>
</div>
<div class="container">
{{-- エラーチェック テスト --}}
{{-- <pre>
	@foreach ($errors->all() as $error)
	{{ $error }}
	@endforeach
</pre> --}}

	@if (Session::has('set_faculty'))
		<div class="alert alert-success text-center">{{ session('set_faculty') }}</div>
	@endif

	<div class="university-faculty-select">

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
				<div class="add-faculty col">
					<div class="card my-3">
						<div class="card-header">
							<span class="d-inline-block">学部を登録する大学名：</span><h4 class="d-inline-block mb-0">{{ $university->name }}</h4>
						</div>
						<div class="card-body">

							<div class="register-faculty">
							{!! Form::open(['route' => ['add.faculty', $university->id]]) !!}
								<div class="form-group row">
									{!! Form::label('faculty_id', '学部名を選択', ['class' => 'col col-form-label my-auto']) !!}
									<div class="col-lg-10">
										{!! Form::select('faculty_id', ['' => '<<登録する学部名を選択してください>>']+array_pluck($faculty_names, 'name', 'id'), old('faculty_id'), ['class' => $errors->has('faculty_id') ? 'form-control is-invalid' : 'form-control', 'required', 'autofocus']) !!}
										<div class="invalid-feedback">{{ $errors->first('faculty_id') }}</div>
									</div>
								</div>
								<div class="form-group row">
									{!! Form::label('overview', '学部の説明', ['class' => 'col col-form-label my-auto']) !!}
									<div class="col-lg-10">
										{!! Form::textarea('overview', old('overview'), ['class' => $errors->has('overview') ? 'form-control is-invalid' : 'form-control', 'required']) !!}
										<div class="invalid-feedback">{{ $errors->first('overview') }}</div>
									</div>
								</div>
								<div class="submit-form text-center">
									{!! Form::button('入力内容を登録する', ['class' => 'btn btn-outline-success', 'type' => 'submit']) !!}
								</div>
							</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
@endsection