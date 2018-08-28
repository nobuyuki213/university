@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')
{{-- テスト用 --}}
{{-- <pre>
	{!! var_dump($tag_ids) !!}
	@if ($tag_ids)
		@foreach ($tag_ids as $t_id)
		{{ var_dump($t_id) }}
		@endforeach
	@endif
</pre> --}}

<div class="university-header jumbotron jumbotron-fluid bg-primary">
    <div class="container">
        <h1 class="text-center text-white">{{ $university->name }}</h1>
    </div>
</div>
<div class="container">
	<div class="search mt-3">
		{!! Form::open(['route' => ['university.show', $university->id], 'method' => 'get']) !!}
			<div class="card border-0" style="margin-bottom:32px;">
				<div class="card-header bg-dark">
					<div class="text-center">
						<h5 class="text-white mb-0">学科を選択</h5>
					</div>
				</div>
				<div class="card-body border border-dark">
					<div class="form-group mb-0 row">

					@if (count($university->courseContents) > 0)
						@foreach ($university->courseContents as $c_content)
							<div class="btn-group-toggle mb-3 col-lg-4 col-md-6" data-toggle="buttons">
								<label class="btn btn-outline-dark d-block @if($course_ids)@foreach($course_ids as $c_id)@if($c_id == $c_content->course->id){{'active'}}@break @endif @endforeach @endif">
									<input type="checkbox" name="course_ids[]" value="{{ $c_content->course->id }}" autocomplete="off" @if ($course_ids) @foreach ($course_ids as $c_id) @if ($c_id == $c_content->course->id) {{ 'checked' }} @break @endif @endforeach @endif> {{ $c_content->course->name }}
								</label>
							</div>
						@endforeach
					@endif

					</div>
				</div>
			</div>
			<div class="card border-0" style="margin-bottom:32px;">
				<div class="card-header bg-info">
					<div class="text-center">
						<h5 class="text-white mb-0">学年を選択</h5>
					</div>
				</div>
				<div class="card-body border border-info">
					<div class="form-group mb-0 row">

						@for ($i = 1; $i <= 4 ; $i++)
							<div class="btn-group-toggle text-center col-md-3 mb-md-0 col-6 @if($i <= 2)mb-3 @endif" data-toggle="buttons">
								<label class="btn btn-outline-info @if($school_years)@foreach($school_years as $s_year)@if($s_year == $i){{'active'}}@break @endif @endforeach @endif">
									<input type="checkbox" name="school_years[]" value="{{$i}}" autocomplete="off" @if ($school_years) @foreach ($school_years as $s_year) @if ($s_year == $i) {{ 'checked' }} @break @endif @endforeach @endif> {{$i}}学年
								</label>
							</div>
						@endfor

					</div>
				</div>
			</div>
			<div class="card border-0" style="margin-bottom:32px;">
				<div class="card-header bg-success">
					<div class="text-center">
						<h5 class="text-white mb-0">タグを選択</h5>
					</div>
				</div>
				<div class="card-body border border-success">
					<div class="form-group mb-0">

						@if (count($tags) > 0)
							@foreach ($tags as $tag)

								<span class="btn-group-toggle d-inline-block mb-2 mr-2" data-toggle="buttons">
									<label class="btn btn-outline-success badge-pill btn-sm @if($tag_ids)@foreach($tag_ids as $t_id)@if($t_id == $tag->id){{'active'}}@break @endif @endforeach @endif">
										<input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" autocomplete="off" @if ($tag_ids) @foreach ($tag_ids as $t_id) @if ($t_id == $tag->id) {{ 'checked' }} @break @endif @endforeach @endif> {{ $tag->name }}
									</label>
								</span>

							@endforeach
						@endif

					</div>
				</div>
			</div>
			<div class="search-botton text-center my-3">
				{!! Form::button('選択した条件で絞り込む <i class="fas fa-search fa-lg"></i>', ['class' => 'btn btn-primary btn-lg hvr-outline-in', 'type' => 'submit']) !!}
			</div>
		{!! Form::close() !!}
	</div>

	@if (isset($course_ids) || isset($school_years) || isset($tag_ids))
		<div class="universiry-search-lessons" id="search">
			@if (isset($message))
				<div class="card" style="margin-top:32px;">
					<div class="card-header">
						<div class="alert alert-danger text-center mb-0">{{ $message }}</div>
					</div>
				</div>
			@else
				<div class="card border-0" style="margin-top:32px;">
					<div class="card-header bg-transparent border-top border-bottom border-dark py-3">
						<h5 class="text-center mb-0">条件にマッチした授業</h5>
					</div>
					<div class="card-body text-center px-lg-3 px-0">
						@foreach ($search_lessons as $s_lesson)
							{!! link_to_route('lesson.show', $s_lesson->name, ['id' => $s_lesson->id], ['class' => 'hvr-grow d-inline-block p-3 mr-1 mb-2 border border-primary', 'style' => 'text-decoration:none;']) !!}
						@endforeach
					</div>
				</div>
			@endif
		</div>
	@endif

</div>
<div class="university-fooder jumbotron jumbotron-fluid bg-dark mb-0" style="margin-top:160px">
	<div class="container">
		<div class="university-lessons">
			<h5 class="text-center text-white">{{ $university->name }}の全授業</h5>
		</div>
		<div class="lessons card bg-transparent">
			<div class="card-body border border-secondary">

			@if (count($lessons) > 0)
				@foreach ($lessons as $lesson)
					{!! link_to_route('lesson.show', $lesson->name, ['id' => $lesson->id], ['class' => 'd-inline-block p-2 mr-1 mb-2 bg-secondary text-white]']) !!}
				@endforeach
			@endif

			</div>
		</div>
	</div>
</div>


@endsection

@section('script')
{{-- サーチ後のページ表示直後にスムーススクロール実行 --}}
<script>
$(function(){
	var speed = 500; //スクロールのスピードを設定（ミリ秒）
	var targetOffset = $('#search').offset().top; //ターゲットとなるdivを設定
	//ページを読み込み0.8秒後にターゲットとなるdivまで自動スクロール
	setTimeout(function(){
		$("html,body").stop().animate({scrollTop:targetOffset},　speed, 'swing');
		return false;
	},500);
})
</script>
@endsection