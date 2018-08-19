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
			<li><a href="{{ route('university.select') }}" style="">選択を変更</a></li>
			<li><a href="javascript:history.back()" style="">レビューを変更</a></li>
			<li class="current"><em>レビューを確認</em></li>
			<li><em>投稿完了</em></li>
		</ol>
	</div>
</div>
<div class="container">
	<div class="text-center m-2">
		<h5 class="d-md-inline-block">{{ $university->name }}</h5>
		<span>のレビューを確認しましょう</span>
	</div>
</div>
<div class="jumbotron jumbotron-fluid">
	<div class="container px-2">

		{!! Form::open(['route' => 'review.store']) !!}

			<div class="selected-review-university">
				<div class="row">
					<div class="col-lg-6 mb-lg-3 mb-1">
						<div class="card border-primary">
							<div class="card-boby p-2">
								<span class="">select:</span> <h5 class="d-inline-block mb-0">{{ $university->name }}</h5>
								<input type="hidden" name="university" value="{{ $university->id }}">
							</div>
						</div>
					</div>
					<div class="col-lg-6 mb-lg-3 mb-1">
						<div class="card border-primary">
							<div class="card-boby p-2">
								<span class="">select:</span> <h5 class="d-inline-block mb-0">{{ $faculty->name }}</h5>
								<input type="hidden" name="faculty" value="{{ $faculty->id }}">
							</div>
						</div>
					</div>
					<div class="col-lg-6 mb-lg-3 mb-1">
						<div class="card border-primary">
							<div class="card-boby p-2">
								<span class="">select:</span> <h5 class="d-inline-block mb-0">{{ $course->name }}</h5>
								<input type="hidden" name="course" value="{{ $course->id }}">
							</div>
						</div>
					</div>
					<div class="col-lg-6 mb-lg-3 mb-1">
						<div class="card border-primary">
							<div class="card-boby p-2">
								<span class="">select:</span> <h5 class="d-inline-block mb-0">{{ $lesson->name }}</h5>
								<input type="hidden" name="lesson" value="{{ $lesson->id }}">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="review-comfirm">
				<div class="card border-0">
					<div class="card-header">
						<p>レビュー内容をご確認ください <span class="badge badge-success font-weight-normal p-2" style="font-size:1rem"><i class="far fa-edit"></i> レビューを投稿する</span> ボタンを押していただくと投稿が完了します</p>
					</div>
					<div class="card-body">
						<div class="content row">
							<div class="content-main col-lg-8">

								@if ($request->title)
								<div class="form-group row border-bottom border-primary pb-3">
									<div class="col-sm-2 my-auto">
										{!! Form::label('title', 'タイトル', ['class' => 'col-form-label text-nowrap']) !!}
									</div>
									<div class="col-md-8 col-sm-10 py-3">
										{!! Form::text('title', $request->title, ['class' => 'form-control-plaintext', 'readonly']) !!}
									</div>
									<div class="col-md-2 my-auto text-right">
										<a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-undo fa-lg"></i> 変更</a>
									</div>
								</div>
								@endif

								@if ($request->body)
								<div class="form-group row border-bottom pb-3">
									<div class="col-sm-2 my-auto">
										{!! Form::label('body', '総合評価', ['class' => 'col-form-label text-nowrap']) !!}
									</div>
									<div class="col-md-8 col-sm-10 py-3">
										{!! Form::textarea('body', $request->body, ['class' => 'form-control-plaintext', 'rows' => 4, 'readonly']) !!}
									</div>
									<div class="col-md-2 my-auto text-right">
										<a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-undo fa-lg"></i> 変更</a>
									</div>
								</div>
								<div class="form-group row border-bottom border-primary pb-3">
									<div class="col-sm-2 my-auto">
										{!! Form::label('body_rating', '評価点数', ['class' => 'col-form-label']) !!}
										<h5 class="d-inline-block px-2 b-0"><span class="badge badge-pill badge-primary">{{ $request->body_rating }}点</span></h5>
									</div>
									<div class="col-md-8 col-sm-10 py-3" style="font-size:2rem;">

										@include('commons.static_rating', ['params' => $request->body_rating])

										{!! Form::hidden('body_rating', $request->body_rating, ['class' => 'form-control-plaintext', 'readonly']) !!}
									</div>
									<div class="col-md-2 my-auto text-right">
										<a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-undo fa-lg"></i> 変更</a>
									</div>
								</div>
								@endif

							</div>
							<div class="content-side col-lg-4 px-lg-3 px-0">
								<div class="card bg-dark p-2 border-0">
									<div class="card-boby">
										{!! Html::decode(Form::button('<i class="far fa-edit"></i> レビューを投稿する', ['class' => 'btn btn-success font-weight-normal w-100', 'style' => 'font-size:1rem;', 'type' => 'submit'])) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		{!! Form::close()!!}

	</div>
</div>


@endsection

@section('script')

@endsection