@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')
<pre>
	{!! var_dump($tag_ids) !!}
	@if ($tag_ids)
		@foreach ($tag_ids as $t_id)
		{{ var_dump($t_id) }}
		@endforeach
	@endif
</pre>

<div class="university-header container">
	<div class="mt-3">
		<div class="">
			<div class="card">
				<div class="card-body p-md-4 p-3">

					<h3 class="card-title mb-0 text-center">{{ $university->name }}</h3>

				</div>
			</div>
		</div>
	</div>
	<div class="search mt-3">
		{!! Form::open(['route' => ['university.show', $university->id], 'method' => 'get']) !!}
			<div class="card mb-3 border-0">
				<div class="card-header bg-transparent border border-info">
					<div class="text-center">
						学科を選択
					</div>
				</div>
				<div class="card-body">
					<div class="form-group row">

					@if (count($university->courseContents) > 0)
						@foreach ($university->courseContents as $c_content)
							<div class="btn-group-toggle mb-3 col-lg-4 col-md-6" data-toggle="buttons">
								<label class="btn btn-outline-info d-block @if($course_ids)@foreach($course_ids as $c_id)@if($c_id == $c_content->course->id){{'active'}}@break @endif @endforeach @endif">
									<input type="checkbox" name="course_ids[]" value="{{ $c_content->course->id }}" autocomplete="off" @if ($course_ids) @foreach ($course_ids as $c_id) @if ($c_id == $c_content->course->id) {{ 'checked' }} @break @endif @endforeach @endif> {{ $c_content->course->name }}
								</label>
							</div>
						@endforeach
					@endif

					</div>
				</div>
			</div>
			<div class="card mb-3 border-0">
				<div class="card-header bg-transparent border border-info">
					<div class="text-center">
						学年を選択
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
				<div class="card-header bg-transparent border border-info">
					<div class="text-center">
						タグを選択
					</div>
				</div>
				<div class="card-body">
					<div class="form-group">

						@if (count($tags) > 0)
							@foreach ($tags as $tag)

								<span class="btn-group-toggle d-inline-block mb-2 mr-2" data-toggle="buttons">
									<label class="btn btn-outline-info badge-pill btn-sm @if($tag_ids)@foreach($tag_ids as $t_id)@if($t_id == $tag->id){{'active'}}@break @endif @endforeach @endif">
										<input type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" autocomplete="off" @if ($tag_ids) @foreach ($tag_ids as $t_id) @if ($t_id == $tag->id) {{ 'checked' }} @break @endif @endforeach @endif> {{ $tag->name }}
									</label>
								</span>

							@endforeach
						@endif

					</div>
				</div>
			</div>
			<div class="search-botton text-center">
				{!! Form::button('絞り込む <i class="fas fa-search fa-lg"></i>', ['class' => 'btn btn-info', 'type' => 'submit']) !!}
			</div>
		{!! Form::close() !!}
	</div>

	<div class="universiry-search-lessons">

		@if (isset($course_ids) || isset($school_years) || isset($tag_ids))
			@if (isset($message))
				<div class="card mt-3">
					<div class="card-header">
						<div class="alert alert-danger text-center mb-0">{{ $message }}</div>
					</div>
				</div>
			@else
				<div class="card border-info mt-3">
					<div class="card-header bg-info text-white border-bottom border-info">
						<div class="text-center">{{ $university->name }}の条件にマッチした授業リスト</div>
					</div>
					<div class="card-body">

						@foreach ($search_lessons as $s_lesson)
							{!! link_to_route('lesson.show', $s_lesson->name, ['id' => $s_lesson->id], ['class' => 'p-2 m-1 border border-primary']) !!}
						@endforeach

					</div>
				</div>
			@endif
		@endif

	</div>

	<div class="university-lessons">
		<div class="card border-dark mt-3">
			<div class="card-header bg-dark text-white border-bottom border-dark">
				<div class="text-center">{{ $university->name }}のすべての授業リスト</div>
			</div>
			<div class="card-body">

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