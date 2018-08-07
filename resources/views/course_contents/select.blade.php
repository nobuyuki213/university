@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4 text-center">学科設定</h1>
    </div>
</div>
<div class="container">
{{-- エラーチェック テスト --}}
{{-- <pre>
	@foreach ($errors->all() as $error)
	{{ $error }}
	@endforeach
</pre> --}}
{{-- <pre>
	@foreach ($faculty_contents as $f_content)
		{{ $f_content->faculty->name }}
	@endforeach
</pre> --}}

	@if (Session::has('set_course'))
		<div class="alert alert-success text-center">{{ session('set_course') }}</div>
	@endif

	<div class="university-faculty-select">

		<div class="select-university">
			のちにここに大学を選択して切り替えできるセレクトボックスの設置予定
		</div>
		<div class="select-faculty">
			<div class="row">
				<div class="offset-lg-1 col-lg-10">
					<div class="card my-3">
						<div class="card-header">
							<span class="d-inline-block">学科を登録する大学名：</span>
							<h4 class="d-inline-block mb-0">{{ $university->name }}</h4>
						</div>
						<div class="card-body">

							<div class="selectable-faculties">
							{{-- {!! Form::open(['route' => ['course.store', $university->id]]) !!}
								<div class="form-group row">
									{!! Form::label('faculty_id', '学部名を選択', ['class' => 'col col-form-label my-auto']) !!}
									<div class="col-lg-10">
										{!! Form::select('faculty_id', ['' => '<<登録する学科に属する学部名を選択してください>>']+array_pluck($faculty_contents, 'faculty.name', 'faculty.id'), old('faculty_id'), ['required', 'autofocus', 'class' => $errors->has('faculty_id') ? 'form-control is-invalid' : 'form-control']) !!}
										@if ($errors->has('faculty_id'))
											<div class="invalid-feedback">{{ $errors->first('faculty_id') }}</div>
										@endif
									</div>
								</div>
							{!! Form::close() !!} --}}{{--セレクトボックス方式のコードは保留--}}
								<div class="how-to-choose alert alert-danger">
									<p class="text-center mb-0">登録する学科に該当する学部名を、以下の中から選択してください</p>
								</div>
								<div class="row">
								@if (count($faculty_contents) > 0)
									@foreach ($faculty_contents as $f_content)
										<div class="col-lg-4 col-sm-6 mb-3">
											{!! link_to_route('course.create', $f_content->faculty->name, ['u_id' => $university->id, 'f_id' => $f_content->id], ['class' => 'btn btn-outline-success d-block hvr-grow']) !!}
										</div>
									@endforeach
								@else
									<div class="alert alert-info">
										<p class="mb-0 text-center">{{ $university->name }} に登録されている学部がありません</p>
										学部を登録する大学のリンク設置
									</div>
								@endif
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

@endsection