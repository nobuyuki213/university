@extends('layouts.app')

@section('stylesheet')
	{{-- user avatar upload CSS --}}
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
@endsection

@section('content')

	@include('commons.user_show_header')

<div class="container-fluid" id="user-page">
	{{-- login user only display --}}
	<div class="user-reviews">
		<div class="reviews-main">
			@if (count($reviews) > 0)
				{{-- 以下のレビュー一覧のスタイルは、のちに共通としてまとめる可能性あり --}}
				@foreach ($reviews as $key => $review)
					<div class="mx-0 mb-3">
						<div class="card">
							<div class="card-header bg-transparent py-2">
								<div class="media">
									<a class="mr-3">
									@if ($review->user->avatar != 'default.jpg')
										<img src="{{ asset('storage/avatars/'. $review->user->id . '/' . $review->user->avatar) }}" class="img-fluid rounded-circle" style="max-width:25px;" alt="user-icon">
									@else
										<img src="{{ asset('storage/avatars/' . $review->user->avatar) }}" class="img-fluid rounded-circle" style="max-width:25px;" alt="user-icon">
									@endif
									</a>
									<div class="media-body my-auto">
										<span class="">{{ $review->user->name }}</span>
									</div>{{-- /.media-body --}}
								</div>{{-- /.media --}}
							</div>
							<div class="review-status card-body">
								<div class="university-status mb-2">
									<a href="{{ route('lesson.show', ['id' => $review->universities->first()->lessons->where('name', $review->universities->first()->pivot->lesson)->first()->id]) }}">
										<h5 class="d-inline-block mb-0">{{ $review->universities->first()->pivot->lesson }}</h5>
									</a><span class="mr-2">の評価・レビュー</span>
									<span class="badge badge-dark">{{ $review->universities->first()->name . '/' . $review->universities->first()->pivot->faculty . '/' . $review->universities->first()->pivot->course }}</span>
								</div>
								<div class="rating">
									<span class="">総合評価点</span>
									<span class="small">
										@include('commons.static_rating', ['params' => $review->rating])
									</span>
									<h5 class="d-inline-block font-weight-bold text-danger mb-0">
										{{ $review->rating }}
									</h5>
								</div>
								<div class="rating-details">
									{{-- のちに項目別のレビューで項目別で評価点を設定した場合の詳細評価点表示スペース --}}
								</div>
								<div class="user-type-status">
									{{-- のちにレビュー者のタイプを表示するスペース 例 在学生/卒業生 入学年度など --}}
								</div>
								<div class="review-main mt-2">
									<h5 class="review-title card-title border-bottom py-1">{{ $review->title }}</h5>
									<h6 class="review-headline p-1" style="border-left:thick solid red;">総合評価</h6>
									<p class="card-text">{{$review->body }}</p>
								</div>
							</div>
							<div class="card-footer clearfix">
								<small class="float-right">
									@include('commons.date', ['date' => $review->created_at])
								</small>
							</div>
						</div>
					</div>
				@endforeach

			@else
				<div class="alert alert-info">
					<p class="mb-0 text-center">レビューはまだしていません</p>
				</div>
			@endif

		</div>
	</div>
</div>

@endsection

@section('script')
	{{-- user avatar upload sprict --}}
	<script src="https://unpkg.com/file-upload-with-preview"></script>
	<script>
		var upload = new FileUploadWithPreview('myUniqueUploadId')
	</script>
@endsection