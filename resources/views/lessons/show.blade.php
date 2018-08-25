@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')
<div class="container">
	{{-- <div class="mt-3 d-inline-block">
		<a href="javascript:history.back()" class="btn btn-outline-secondary btn-sm"><i class="fas fa-undo fa-lg"></i> 戻る</a>
	</div> --}}
	<div class="lesson-header row mt-3">
		<div class="col">
			<div class="card shadow-sm">
				<div class="card-body clearfix">

					{{-- お気に入り記述スペース --}}

					<h4 class="card-title">{{ $lesson->name }}</h4>

					<div class="lesson-review-status mb-1">
						{{-- 授業に対するレビューのステータス記述スペース --}}
					</div>
					@if (count($lesson->tags) > 0)
						<div class="lesson-tags mt-3 float-left">
							<i class="fas fa-tags text-success align-bottom"></i>
							@foreach ($lesson->tags as $tag)
								<span class="badge badge-pill badge-success">{{ $tag->name }}</span>
							@endforeach
						</div>
					@endif
					{{-- 以下の先輩のコメントは、のちにifで表示・非表示の分岐にする --}}
					<div class="nav-scroll senior-comment mt-2 float-right">
						<a href="#senior" class="btn btn-warning btn-sm hvr-icon-hang">
							先輩のコメント <i class="fa fa-chevron-down hvr-icon"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</div>{{-- lesson-header end --}}
	<div class="lesson-basic-details mt-3">
		<div class="row">

			<div class="col-md-4 mb-3">
				<div class="university">
					<div class="card text-center border-primary">
						<div class="card-header">
							<p class="mb-0">University</p>
						</div>
						<div class="card-body">
							<h5 class="mb-0">{{ $lesson->university->name }}</h5>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="faculty">
					<div class="card text-center border-primary">
						<div class="card-header">
							<p class="mb-0">faculty</p>
						</div>
						<div class="card-body">
							<h5 class="mb-0">{{ $lesson->faculty->name }}</h5>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="course">
					<div class="card text-center border-primary">
						<div class="card-header">
							<p class="mb-0">course</p>
						</div>
						<div class="card-body">
							<h5 class="mb-0">{{ $lesson->course->name }}</h5>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="school_year">
					<div class="card text-center border-primary">
						<div class="card-header">
							<p class="mb-0">school year</p>
						</div>
						<div class="card-body">
							<h5 class="mb-0">{{ $lesson->school_year }}学年</h5>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="teacher">
					<div class="card text-center border-primary">
						<div class="card-header">
							<p class="mb-0">teacher</p>
						</div>
						<div class="card-body">
							<h5 class="mb-0">{{ $lesson->teacher_name }}</h5>
						</div>
					</div>
				</div>
			</div>

			<div class="offset-md-4">
			</div>

			<div class="col-md-12 mb-3">
				<div class="textbook">
					<div class="card text-center border-primary">
						<div class="card-header">
							<p class="mb-0">textbook</p>
						</div>
						<div class="card-body">
							<h5 class="mb-0 text-left">{{ $lesson->textbook_name }}</h5>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>{{-- lesson-basic-details end --}}
	<div class="lesson-test-details mt-3">
		<div class="lesson-test-headline mb-3">
			<div class="card">
				<div class="card-header bg-danger">
					<h3 class="text-white mb-0">テスト</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 mb-3">
				<div class="intermediate-test h-100">
					<div class="card text-center border-danger h-100">
						<div class="card-header">
							<p class="mb-0">中間テスト</p>
						</div>
						<div class="card-body">
							@if ($lesson->is_intermediate_test == 1)
								<h5 class="my-2">ある</h5>
							@else
								<h5 class="my-2">ない</h5>
							@endif
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="intermediate-level h-100">
					<div class="card text-center border-danger h-100">
						<div class="card-header">
							<p class="mb-0">中間テストの難易度</p>
						</div>
						<div class="card-body">

							@include('commons.static_difficulty', ['params' => $lesson->intermediate_level])

						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="intermediate-report h-100">
					<div class="card text-center border-danger h-100">
						<div class="card-header">
							<p class="mb-0">中間のレポート</p>
						</div>
						<div class="card-body">
							@if ($lesson->is_intermediate_report == 1)
								<h5 class="my-2">ある</h5>
							@else
								<h5 class="my-2">ない</h5>
							@endif
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="final-test h-100">
					<div class="card text-center border-danger h-100">
						<div class="card-header">
							<p class="mb-0">期末テスト</p>
						</div>
						<div class="card-body">
							@if ($lesson->is_final_test == 1)
								<h5 class="my-2">ある</h5>
							@else
								<h5 class="my-2">ない</h5>
							@endif
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="final-level h-100">
					<div class="card text-center border-danger h-100">
						<div class="card-header">
							<p class="mb-0">期末テストの難易度</p>
						</div>
						<div class="card-body">

							@include('commons.static_difficulty', ['params' => $lesson->final_level])

						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4 mb-3">
				<div class="final-report h-100">
					<div class="card text-center border-danger h-100">
						<div class="card-header">
							<p class="mb-0">期末のレポート</p>
						</div>
						<div class="card-body">
							@if ($lesson->is_final_report == 1)
								<h5 class="my-2">ある</h5>
							@else
								<h5 class="my-2">ない</h5>
							@endif
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12 mb-3">
				<div class="test_range">
					<div class="card text-center border-danger">
						<div class="card-header">
							<p class="mb-0">テスト範囲(出題傾向)</p>
						</div>
						<div class="card-body">
							<p class="text-primary mb-0">{{ $lesson->test_range}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>{{-- lesson-test-details end --}}
	<div class="lesson-attend-details mt-3">
		<div class="lesson-attend-headline mb-3">
			<div class="card">
				<div class="card-header bg-success">
					<h3 class="text-white mb-0">出席</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 mb-3">
				<div class="attend">
					<div class="card text-center border-success">
						<div class="card-header">
							<p class="mb-0">出席</p>
						</div>
						<div class="card-body">
							@switch($lesson->attend)
								@case('取らない') <h5 class="">取らない</h5> @break
								@case('時々取る')	 <h5 class="">時々取る</h5> @break
								@case('ほぼ毎回取る') <h5 class="">ほぼ毎回取る</h5> @break
								@case('取る') <h5 class="">取る</h5> @break
							@endswitch
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 mb-3">
				<div class="attendance-method">
					<div class="card text-center border-success">
						<div class="card-header">
							<p class="mb-0">出席の取り方</p>
						</div>
						<div class="card-body">
							<h5 class="">{{ $lesson->attendance_method }}</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>{{-- lesson-attend-details --}}
	<div class="lesson-remarks mt-3">
		<div class="lesson-remarks-headline mb-3">
			<div class="card">
				<div class="card-header bg-info">
					<h3 class="text-white mb-0">備考</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 mb-3">
				<div class="remarks">
					<div class="card text-center border-info">
						<div class="card-body">
							<p class="text-primary mb-0">{{ $lesson->remarks}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>{{-- Lesson-remarks end --}}
	<div class="senior-comment my-3" id="senior">
		<div class="senior-comment-headline mb-3">
			<div class="card">
				<div class="card-header bg-warning">
					<h3 class="text-white mb-0">先輩のコメント</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 mb-3">
				<div class="comment">
					<div class="card border-warning">
						<div class="card-body">
							<p class="text-primary mb-0">{{ $lesson->remarks}}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>{{-- senior-comment end --}}
</div>
@endsection

@section('script')
<!-- スムーズスクロール部分の記述 -->
<script>
$(function(){
	// #で始まるアンカーをクリックした場合に処理
	$('a[href^=#senior]').click(function() {
		// スクロールの速度
		var speed = 600; // ミリ秒
		// アンカーの値取得
		var href= $(this).attr("href");
		// 移動先を取得
		var target = $(href == "#" || href == "" ? 'html' : href);
		// 移動先を数値で取得
		var position = target.offset().top;
		// スムーススクロール
		$('body,html').animate({scrollTop:position}, speed, 'swing');
		return false;
		});
	});
</script>
@endsection