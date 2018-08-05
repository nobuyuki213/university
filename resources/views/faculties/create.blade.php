@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4 text-center">学部マスタ登録</h1>
    </div>
</div>
<div class="container">

	@if (Session::has('faculty_create'))
	<div class="alert alert-success test-center">{{ session('faculty_create') }}</div>
	@endif

	<div class="faculty-create mb-3">
		{!! Form::model($faculty, ['route' => 'faculty.store']) !!}

		<div class="form-group">
			{!! Form::label('name', '学部名', ['class' => 'col-form-lable']) !!}
			{!! Form::text('name', old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control border-secondary border-bottom', 'required', 'autofocus']) !!}
			@if ($errors->has('name'))
				<span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
			@endif
		</div>

		<div class="submit-form text-center">
			{{ Form::button('入力内容を登録する', ['class' => 'btn btn-outline-success', 'type' => 'submit']) }}
		</div>

		{!! Form::close() !!}
	</div>

	<div class="faculties mb-3">
		<div class="card">
			<div class="card-header bg-transparent ">
				<h4 class="mb-0 text-center">学部一覧</h4>
			</div>
			<div class="faculty-list card-body">
			@if (count($faculties) > 0)
				<div class="row">
				@foreach ($faculties as $faculty)
					<div class="col-lg-3 col-md-4 col-6">
						<div class="card border border-primary mb-3">
							<div class="card-body">
								<p class="mb-0 text-primary text-center">{{ $faculty->name }}</p>
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