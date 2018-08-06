@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid bg-info">
    <div class="container">
        <h1 class="display-4 text-center text-white">学科名マスタ登録</h1>
    </div>
</div>
<div class="container">

	@if (Session::has('course_create'))
	<div class="alert alert-info text-center">{{ session('course_create') }}</div>
	@endif

	<div class="course-create mb-3">
		{!! Form::model($course, ['route' => 'course.store']) !!}

		<div class="form-group">
			{!! Form::label('name', '学部名', ['class' => 'col-form-lable']) !!}
			{!! Form::text('name', old('name'), ['required', 'autofocus', 'class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control border-secondary border-bottom']) !!}
			@if ($errors->has('name'))
				<span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
			@endif
		</div>

		<div class="submit-form text-center">
			{{ Form::button('入力内容を登録する', ['class' => 'btn btn-outline-info', 'type' => 'submit']) }}
		</div>

		{!! Form::close() !!}
	</div>

	<div class="courses mb-3">
		<div class="card">
			<div class="card-header bg-transparent ">
				<h4 class="mb-0 text-center">学科一覧</h4>
			</div>
			<div class="course-list card-body">
			@if (count($courses) > 0)
				<div class="row">
				@foreach ($courses as $course)
					<div class="col-lg-3 col-md-4 col-6">
						<div class="card border border-primary mb-3">
							<div class="card-body">
								<p class="mb-0 text-primary text-center">{{ $course->name }}</p>
							</div>
						</div>
					</div>
				@endforeach
				</div>
			@endif
			</div>
		</div>
	</div>

</div>
@endsection