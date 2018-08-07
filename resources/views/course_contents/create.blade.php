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

	@if (Session::has('create_course'))
		<div class="alert alert-success text-center">{{ session('create_course') }}</div>
	@endif

	<div class="university-faculty-course">

		<div class="setting-courses">
			<div class="row">
				<div class="set-course col-lg-3">
					<div class="card border-info mt-3">
						<div class="card-header bg-info text-white text-center">
							<span class="">登録済学科</span>
						</div>
						<div class="card-body">
						@if (count($course_contents) > 0)
							@foreach ($course_contents as $course_content)
							<div class="registered-course clearfix">
								<div class="float-right pt-1">
									{!! Html::decode(link_to_route('course.edit', '<i class="far fa-edit"></i>', ['$u_id' => $university->id, '$f_id' => $faculty_content->id, '$c_id' => $course_content->id])) !!}
								</div>
								<div class="mb-2 px-3 py-1 border-left border-info">
									{{ $course_content->course->name }}
								</div>
							</div>
							@endforeach
						@else
							<div class="not-course">
								<div class="mb-2 px-3 py-1 border-left border-info">
									未登録
								</div>
							</div>
						@endif
						</div>
					</div>
				</div>
				<div class="add-course col">
					<div class="card my-3">
						<div class="card-header">
							<div class="university d-md-inline-block">
								<span class="d-inline-block">大学名：</span><h4 class="d-inline-block mb-0">{{ $university->name }}</h4>
							</div>
							<div class="faculty d-md-inline-block">
								<span class="d-inline-block">学部名：</span><h4 class="d-inline-block mb-0">{{ $faculty->name }}</h4>
							</div>
						</div>
						<div class="card-body">
							<div class="register-course">
							{!! Form::open(['route' => ['course.store', 'u_id' => $university->id, 'f_id' => $faculty_content->id]]) !!}
								<div class="form-group row">
									{!! Form::label('course_id', '学科名を選択', ['class' => 'col col-form-label my-auto']) !!}
									<div class="col-lg-10">
										{!! Form::select('course_id', ['' => '<< 登録する学科名を選択してください >>']+array_pluck($course_names, 'name', 'id'), old('course_id'), ['required', 'autofocus', 'class' => $errors->has('course_id') ? 'form-control is-invalid' : 'form-control']) !!}
										@if ($errors->has('course_id'))
											<div class="invalid-feedback">{{ $errors->first('course_id') }}</div>
										@endif
									</div>
								</div>
								<div class="form-group row">
									{!! Form::label('feature', '学科の説明', ['class' => 'col col-form-label my-auto']) !!}
									<div class="col-lg-10">
										{!! Form::textarea('feature', old('feature'), ['required', 'class' => $errors->has('feature') ? 'form-control is-invalid' : 'form-control']) !!}
										@if ($errors->has('feature'))
											<div class="invalid-feedback">{{ $errors->first('feature') }}</div>
										@endif
									</div>
								</div>
								<div class="submit-form text-center">
									{!! Form::button('入力内容を登録する', ['class' => 'btn btn-outline-success', 'type' => 'submit']) !!}
								</div>
							{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
@endsection