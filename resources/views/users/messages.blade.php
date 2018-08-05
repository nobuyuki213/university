@extends('layouts.app')

@section('stylesheet')
	{{-- user avatar upload CSS --}}
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
@endsection

@section('content')

	@include('commons.user_show_header')

<div class="container-fluid" id="user-page">
	<div class="all-messages">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="card border-0">
					<div class="card-header">
						<p class="mb-0">メッセージ：{{ $part_user->name }}さん</p>
					</div>
					<div class="message card-body">
					@foreach ($all_messages as $message)
					@if ($message->user_id == $user->id)
					<div class="row">
						<div class="offset-2 col-10 d-inline-flex justify-content-end">
							<div class="card mb-3 border-success hvr-glow">
								<div class="card-body" style="position:relative;">
									<span class="badge badge-success" style="position:absolute;top:0;right:0;">{{ $user->name }}</span>
									<p class="">{{ $message->message }}</p>
									<small class="d-block text-right">{{ $message->created_at }}</small>
								</div>
							</div>
						</div>
					</div>
					@else
					<div class="row">
						<div class="col-10">
							<div class="card mb-3 border-warning hvr-glow">
								<div class="card-body" style="position:relative;">
									<span class="badge badge-warning" style="position:absolute;top:0;left:0;">{{ $part_user->name }}</span>
									<p class="">{{ $message->message }}</p>
									<small class="d-block text-left">{{ $message->created_at }}</small>
								</div>
							</div>
						</div>
					</div>
					@endif
					@endforeach
					</div>
					<div class="card-footer">

					</div>
				</div>
			</div>
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
@endsection()