@extends('layouts.app')

@section('stylesheet')
	<!--breadcrumbs Css -->
	<link href="{{ asset('css/bread_style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/reset.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="jumbotron jumbotron-fluid bg-primary">
	<div class="container">
		<ol class="cd-breadcrumb triangle">
			<li class="current"><em>大学選択</em></li>
			<li><em>レビューを書く</em></li>
			<li><em>レビューを確認</em></li>
			<li><em>投稿完了</em></li>
		</ol>
	</div>
</div>
<div class="container">
{{-- エラーチェック テスト --}}
	@forelse ($errors->all() as $error)
		<div class="alert alert-danger text-center">{{ $error }}</div>
	@empty
	@endforelse

	@if (Session::has('error'))
		<div class="alert alert-danger text-center">{{ session('error') }}</div>
	@endif

	@forelse ($universities as $univer)

		{!! Form::open(['route' => 'review.input', 'method' => 'get']) !!}
		<div class="form-group row justify-content-lg-center">

			<select name="select" class="dependent custom-select text-center col-lg mx-3 p-3 border border-primary" required>
				<option value="">大学を選択</option>
				@foreach ($univer->facultyContents as $f_content)
					@foreach ($f_content->courseContents as $c_content)
						@foreach ($c_content->course->lessons as $lesson)
							<option value="{{ $univer->id . ',' . $f_content->faculty->id . ',' . $c_content->course->id}}">{{ $univer->name .' > '. $f_content->faculty->name .' > '. $c_content->course->name . ' > ' . $lesson->name }}</option>
						@endforeach
					@endforeach
				@endforeach
			</select>

		</div>

{{-- 		<div class="form-group">
			<div class="custom-control custom-checkbox">
				{!! Form::checkbox('provider', 0, false, ['class' => 'custom-control-input', 'id' => 'provider']) !!}
				{!! Html::decode(Form::label('provider', '<a href="#">利用規約</a>を同意の上、レビューする', ['class' => 'custom-control-label'])) !!}
			</div>
		</div> --}}
		<div class="submit-form text-center mt-5">
			{!! Form::button('レビューを書く', ['class' => 'btn btn-outline-primary', 'type' => 'submit', 'id' => 'submitbtn']) !!}
		</div>

		{!! Form::close() !!}

	@empty
		登録された大学がありません。
	@endforelse


</div>



@endsection

@section('script')
	<!-- dependent-selects.js Scripts -->
	<script src="{{ asset('js/jquery.dependent-selects.js') }}"></script>
	<script type="text/javascript">
	$(function(){
		$('.dependent').dependentSelects({
			placeholderOption: ['学部を選択', '学科を選択'],
			class: 'custom-select col-lg mx-3 p-3 border border-primary',
		});
	})
	</script>
@endsection