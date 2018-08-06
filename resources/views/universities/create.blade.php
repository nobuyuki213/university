@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4 text-center">大学登録</h1>
    </div>
</div>
<div class="container">

	@if (Session::has('create'))
		<div class="alert alert-success test-center">{{ session('create') }}</div>
	@endif

	<div class="university-create mb-3">
		{!! Form::model($university, ['route' => 'university.store', ]) !!}

		<div class="form-group">
			{!! Form::label('name', '大学名', ['class' => 'font-weight-bold']) !!}
			{!! Form::text('name', old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control border-secondary border-bottom', 'required','autofocus']) !!}
			@if ($errors->has('name'))
				<span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
			@endif
		</div>

		<div class="form-group">
			{!! Form::label('description', '大学の説明') !!}
			{!! Form::textarea('description', old('description'), ['class' => $errors->has('description') ? 'form-control is-invalid' : 'form-control border-secondary border-bottom', 'required']) !!}
			@if ($errors->has('description'))
				<span class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
			@endif
		</div>

		<div class="form-group">
			{!! Form::label('address', '住所') !!}
			{!! Form::text('address', old('address'), ['class' => $errors->has('address') ? 'form-control is-invalid' : 'form-control border-secondary border-bottom', 'required']) !!}
			@if ($errors->has('address'))
				<span class="invalid-feedback"><strong>{{ $errors->first('address') }}</strong></span>
			@endif
			<small>（入力例）広島県東広島市黒瀬学園台555-36</small>
		</div>

		<div class="form-group">
			{!! Form::label('phone_number', '電話番号') !!}
			{!! Form::text('phone_number', old('phone_number'), ['class' => $errors->has('phone_number') ? 'form-control is-invalid' : 'form-control border-secondary border-bottom', 'required']) !!}
			@if ($errors->has('phone_number'))
				<span class="invalid-feedback"><strong>{{ $errors->first('phone_number') }}</strong></span>
			@endif
			<small>（入力例）000-0000-0000</small>
		</div>

		<div class="form-group">
			{!! Form::label('url', '公式サイト') !!}
			{!! Form::text('url', old('url'), ['class' => $errors->has('url') ? 'form-control is-invalid' : 'form-control border-secondary border-bottom', 'required']) !!}
			@if ($errors->has('url'))
				<span class="invalid-feedback"><strong>{{ $errors->first('url') }}</strong></span>
			@endif
			<small>（入力例）http://www.hirokoku-u.ac.jp</small>
		</div>

		<div class="submit-form text-center">
			{!! Form::button('入力内容を登録する', ['class' => 'btn btn-outline-success', 'type' => 'submit']) !!}
		</div>

		{!! Form::close() !!}
	</div>

	<div class="universities mb-3" style="height:300PX">
		<div class="card">
			<div class="card-header bg-transparent">
				<h4 class="mb-0 text-center">大学一覧</h4>
			</div>
			<div class="dept-list card-body">
			@if (count($universities) > 0)
				<div class="row">
				@foreach ($universities as $univer)
					<div class="col-lg-3 col-md-4 col-6">
						<div class="card border border-primary mb-3">
							<div class="card-body p-0">
								<div class="dropdown">
									<div class="p-3 mb-0 text-primary text-center dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										{{ $univer->name }}
									</div>
									<div class="dropdown-menu border-success" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="{{ route('select.faculty', ['id' => $univer->id]) }}">学部設定</a>
										<div class="dropdown-divider"></div>
									</div><!-- /.dropdown-menu -->
								</div><!-- /.dropdown -->
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