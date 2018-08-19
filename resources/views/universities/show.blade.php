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

<div class="university-header container">
	<div class="my-5">
		<div class="">
			<div class="card border-0">
				<div class="card-body p-md-4 p-3 bg-primary border-primary">

					<h3 class="card-title mb-0 text-center text-white">{{ $university->name }}</h3>

				</div>
			</div>
		</div>
	</div>
	<div class="search mt-3">
		{!! Form::open(['route' => ['university.show', $university->id], 'method' => 'get']) !!}
			<div class="card mb-3 border-0">
				<div class="card-header bg-info border border-info">
					<div class="text-center">
						<span class="text-white">学科を選択</span>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group row">

					@if (count($university->courseContents) > 0)
						@foreach ($university->courseContents as $c_content)
							<div class="btn-group-toggle mb-3 col-lg-4 col-md-6" data-toggle="buttons">
								<label class="btn btn-outline-primary d-block @if($course_ids)@foreach($course_ids as $c_id)@if($c_id == $c_content->course->id){{'active'}}@break @endif @endforeach @endif">
									<input type="checkbox" name="course_ids[]" value="{{ $c_content->course->id }}" autocomplete="off" @if ($course_ids) @foreach ($course_ids as $c_id) @if ($c_id == $c_content->course->id) {{ 'checked' }} @break @endif @endforeach @endif> {{ $c_content->course->name }}
								</label>
							</div>
						@endforeach
					@endif

					</div>
				</div>
			</div>
			<div class="card mb-3 border-0">
				<div class="card-header bg-info border border-info">
					<div class="text-center">
						<span class="text-white">学年を選択</span>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group row">

						@for ($i = 1; $i <= 4 ; $i++)
							<div class="btn-group-toggle mb-3 col-md-3 col-6 text-center" data-toggle="buttons">
								<label class="btn btn-outline-primary @if($school_years)@foreach($school_years as $s_year)@if($s_year == $i){{'active'}}@break @endif @endforeach @endif">
									<input type="checkbox" name="school_years[]" value="{{$i}}" autocomplete="off" @if ($school_years) @foreach ($school_years as $s_year) @if ($s_year == $i) {{ 'checked' }} @break @endif @endforeach @endif> {{$i}}学年
								</label>
							</div>
						@endfor

					</div>
				</div>
			</div>
			<div class="card mb-3 border-0">
				<div class="card-header bg-info border border-info">
					<div class="text-center">
						<span class="text-white">タグを選択</span>
					</div>
				</div>
				<div class="card-body">
					<div class="form-group">

						@if (count($tags) > 0)
							@foreach ($tags as $tag)

								<span class="btn-group-toggle d-inline-block mb-2 mr-2" data-toggle="buttons">
									<label class="btn btn-outline-primary badge-pill btn-sm @if($tag_ids)@foreach($tag_ids as $t_id)@if($t_id == $tag->id){{'active'}}@break @endif @endforeach @endif">
										<input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" autocomplete="off" @if ($tag_ids) @foreach ($tag_ids as $t_id) @if ($t_id == $tag->id) {{ 'checked' }} @break @endif @endforeach @endif> {{ $tag->name }}
									</label>
								</span>

							@endforeach
						@endif

					</div>
				</div>
			</div>
			<div class="search-botton text-center my-3">
				{!! Form::button('選択した条件で絞り込む <i class="fas fa-search fa-lg"></i>', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
			</div>
		{!! Form::close() !!}
	</div>

	@if (isset($course_ids) || isset($school_years) || isset($tag_ids))
		<div class="universiry-search-lessons mt-3">
			@if (isset($message))
				<div class="card">
					<div class="card-header">
						<div class="alert alert-danger text-center mb-0">{{ $message }}</div>
					</div>
				</div>
			@else
				<div class="card border-0 mt-3">
					<div class="card-header bg-info text-white border-bottom border-info">
						<div class="text-center">{{ $university->name }}の条件にマッチした授業リスト</div>
					</div>
					<div class="card-body border border-info">
						@foreach ($search_lessons as $s_lesson)
							{!! link_to_route('lesson.show', $s_lesson->name, ['id' => $s_lesson->id], ['class' => 'p-2 m-1 border border-primary']) !!}
						@endforeach
					</div>
				</div>
			@endif
		</div>
	@endif

	<div class="university-lessons my-3">
		<div class="card border-dark border-0">
			<div class="card-header bg-dark text-white border-bottom border-dark">
				<div class="text-center">{{ $university->name }}のすべての授業リスト</div>
			</div>
			<div class="card-body border border-dark">

			@if (count($lessons) > 0)
				@foreach ($lessons as $lesson)
					{!! link_to_route('lesson.show', $lesson->name, ['id' => $lesson->id], ['class' => 'p-2 m-1 border border-primary']) !!}
				@endforeach
			@endif

			</div>
		</div>
	</div>
</div>

@endsection

@section('script')

@endsection