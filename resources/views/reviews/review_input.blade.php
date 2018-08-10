@extends('layouts.app')

@section('stylesheet')
	<!--breadcrumbs Css -->
	<link href="{{ asset('css/bread_style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/reset.css') }}" rel="stylesheet">
@endsection

@section('stylesheet_fontawesome_after')
	{{-- rating Css --}}
	<link href="{{ asset('css/fontawesome-stars.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="jumbotron jumbotron-fluid bg-primary">
	<div class="container">
		<ol class="cd-breadcrumb triangle">
			<li><a href="{{ route('university.select') }}" style="">選択を変更</a></li>
			<li class="current"><em>レビューを書く</em></li>
			<li><em>レビューを確認</em></li>
			<li><em>投稿完了</em></li>
		</ol>
	</div>
</div>
<div class="container">
	<div class="text-center m-2">
		<h5 class="d-md-inline-block">{{ $university->name }}</h5>
		<span>のレビューを書きましょう</span>
	</div>
</div>

{{-- エラーチェック テスト --}}
{{-- <pre>
	@foreach ($errors->all() as $error)
	{{ $error }}
	@endforeach
</pre> --}}
{{-- エラーチェック テストここまで --}}

<div class="jumbotron jumbotron-fluid">
	<div class="container">
		{!! Form::open(['route' => 'review.comfirm']) !!}

			<div class="selected-review-university">
				<div class="row">
					<div class="col-lg-4 mb-lg-3 mb-1">
						<div class="card border-primary">
							<div class="card-boby p-2">
								<span class="">select:</span> <h5 class="d-inline-block mb-0">{{ $university->name }}</h5>
								<input type="hidden" name="university" value="{{ $university->id }}">
							</div>
						</div>
					</div>
					<div class="col-lg-4 mb-lg-3 mb-1">
						<div class="card border-primary">
							<div class="card-boby p-2">
								<span class="">select:</span> <h5 class="d-inline-block mb-0">{{ $faculty->name }}</h5>
								<input type="hidden" name="faculty" value="{{ $faculty->id }}">
							</div>
						</div>
					</div>
					<div class="col-lg-4 mb-lg-3 mb-1">
						<div class="card border-primary">
							<div class="card-boby p-2">
								<span class="">select:</span> <h5 class="d-inline-block mb-0">{{ $course->name }}</h5>
								<input type="hidden" name="course" value="{{ $course->id }}">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="review-create">
				<div class="card mb-3">
					<div class="card-header bg-transparent">
						<h4 class="card-title mb-0"><i class="far fa-edit"></i> レビューを書く</h4>
					</div>
					<div class="card-body px-2">
						{{-- ここからレビュー開始 --}}
						<div class="card border-0">
							<div class="card-header border border-secondary">
								<span class="card-title font-weight-bold">レビューのタイトル</span>
							</div>
							<div class="card-body">
								<div class="form-group　mb-0">
									{!! Form::text('title', old('title'), ['required', 'autofocus', 'placeholder' => '（例）大学生活は充実。教員や大学施設など満足してます。', 'class' => $errors->has('title') ? 'form-control is-invalid' : 'form-control']) !!}
									@if ($errors->has('title'))
										<div class="invalid-feedback">{{ $errors->first('title') }}</div>
									@endif
								</div>
							</div>
						</div>

						<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
							<div class="card">
								<div class="card-header" role="tab" id="headingOne">
									<h5 class="mb-0">
										<a class="text-body" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="true" aria-controls="collapse1">
											<span><i class="far fa-check-square"></i> 総合評価</span>
										</a>
									</h5>
								</div><!-- /.card-header -->
								<div id="collapse1" class="{{ $errors->has('body') || $errors->has('body_rating') ? 'collapse show' : 'collapse'}}" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
									<div class="card-body px-md-3 px-1">
										{{-- ここから総合評価のレビュー --}}
										<h5 class="write card-title"><i class="far fa-check-circle"></i> 総合評価を書きましょう</h5>
										<div class="form-group">
											{!! Form::textarea('body', old('body'), ['required', 'placeholder' => 'どんな大学か教えてください', 'class' => $errors->has('body') ? 'form-control is-invalid' : 'form-control']) !!}
											@if ($errors->has('body'))
												<div class="invalid-feedback">{{ $errors->first('body') }}</div>
											@endif
										</div>
										<div class="card card-body border-bottom my-3 p-3">
											<p class="bg-success text-white px-3 py-2 mb-3">記入のヒント</p>
											<p class="text-muted">どんな場所にあるか？大学や教員の雰囲気はどうか？大学の清潔感はどうか？</p>
										</div>
										{{-- 総合評価のレビューここまで --}}
										{{-- ここから総合評価のレーティング --}}
										<h5 class="rating card-title"><i class="far fa-check-circle"></i> 総合評価を評価する</h5>
										<div class="form-group mb-0">
											<select id="body_rating" name="body_rating">
												<option value=""></option>
												<option value="1" {{ old('body_rating') == 1 ? 'selected' : '' }}>1</option>
												<option value="2" {{ old('body_rating') == 2 ? 'selected' : '' }}>2</option>
												<option value="3" {{ old('body_rating') == 3 ? 'selected' : '' }}>3</option>
												<option value="4" {{ old('body_rating') == 4 ? 'selected' : '' }}>4</option>
												<option value="5" {{ old('body_rating') == 5 ? 'selected' : '' }}>5</option>
											</select>
											@if (!empty($errors->first('body_rating')))
												<div class="alert alert-dismissible alert-danger mt-3 mb-0">
													<button type="button" class="close" data-dismiss="alert">&times;</button>
													<small><i class="fas fa-exclamation-triangle"></i> {{ $errors->first('body_rating') }}</small>
												</div>
											@endif
										</div>
										{{-- 総合評価のレーティングここまで --}}
									</div><!-- /.card-body -->
								</div><!-- /.collapse -->
							</div><!-- /.card -->
							<div class="card">
								<div class="card-header" role="tab" id="headingTwo">
									<h5 class="mb-0">
										<a class="collapsed text-body" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
											アイテム2
										</a>
									</h5>
								</div><!-- /.card-header -->
								<div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
									<div class="card-body">
										アイテム2のコンテンツ
									</div><!-- /.card-body -->
								</div><!-- /.collapse -->
							</div><!-- /.card -->
							<div class="card">
								<div class="card-header" role="tab" id="headingThree">
									<h5 class="mb-0">
										<a class="collapsed text-body" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">
											アイテム3
										</a>
									</h5>
								</div><!-- /.card-header -->
								<div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
									<div class="card-body">
										アイテム3のコンテンツ
									</div><!-- /.card-body -->
								</div><!-- /.collapse -->
							</div><!-- /.card -->
						</div><!-- /#accordion -->

					</div>
				</div>

				<div class="review-button text-center">
					{!! Form::button('入力内容を確認する', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
				</div>
			</div>

		{!! Form::close() !!}
	</div>
</div>

@endsection

@section('script')
	{{-- rating sprict --}}
	<script src="{{ asset('js/jquery.barrating.min.js') }}"></script>
	<script>
	$(function() {
		$('#body_rating').barrating({
			theme: 'fontawesome-stars'
		});
	});
	</script>
@endsection