@extends('layouts.app')

@section('stylesheet')
	{{-- user avatar upload CSS --}}
	<link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview/dist/file-upload-with-preview.min.css">
@endsection

@section('content')

	@include('commons.user_show_header')

{{-- ログインユーザーだげに表示されるコンテンツ --}}
@if (Auth::check() && Auth::user()->id == $user->id)
<div class="container-fluid" id="user-page">
	{{ 'ログインしたユーザ本人だけ表示されるコンテンツ' }}
	<div class="user-messages">

		<!-- タブ部分 -->
		<ul id="messageTab" class="nav nav-tabs" role="tablist">
			<li class="nav-item">
				<a href="#receive" id="receive-tab" class="nav-link active" role="tab" data-toggle="tab" aria-controls="receive" aria-selected="true">受信DM</a>
			</li>
			<li class="nav-item">
				<a href="#send" id="send-tab" class="nav-link" role="tab" data-toggle="tab" aria-controls="send" aria-selected="false">送信DM</a>
			</li>
		</ul>
		<!-- パネル部分 -->
		<div id="messageTabContent" class="tab-content mt-3">

			<div id="receive" class="tab-pane active" role="tabpanel" aria-labelledby="receive-tab">
			@if (count($receive_msgs) > 0)
				<div class="send-messages card border-0">
					<div class="row">
					@php $user_id = ['0' => 'name'] @endphp
					@foreach ($receive_msgs as $key => $r_msg)
						@if (!array_has($user_id, $r_msg->id))
						<div class="col-lg-3 col-sm-4 col-6">
						{!! Form::open(['route' => ['user.messages', Auth::user()->id], 'method' => 'get', 'name' => "formreceive{$key}"]) !!}
							{!! Form::hidden('user', $r_msg->id) !!}
							<a href="javascript:formreceive{{$key}}.submit()" class="">
								<div class="card message-item hvr-float w-100">
									<div class="card-body">
										<p class="mb-0 text-center">
											Form:<span class="ml-1">{{ $r_msg->name }}さん</span>
										</p>
									</div>
								</div>
							</a>
						{!! Form::close() !!}
						</div>
						@php $user_id += [$r_msg->id => $r_msg->name] @endphp
						@endif
					@endforeach
					</div>
				</div>
			@else
				<div class="alert alert-info">
					<p class="mb-0 text-center">メッセージを受け取った相手はいません</p>
				</div>
			@endif
			</div>

			<div id="send" class="tab-pane" role="tabpanel" aria-labelledby="send-tab">
			@if (count($sent_msgs) > 0)
				<div class="send-messages card border-0">
					<div class="row">
					@php $user_id = ['0' => 'name'] @endphp
					@foreach ($sent_msgs as $key => $s_msg)
						@if (!array_has($user_id, $s_msg->id))
						<div class="col-lg-3 col-sm-4 col-6">
						{!! Form::open(['route' => ['user.messages', Auth::user()->id], 'method' => 'get', 'name' => "formsend{$key}"]) !!}
							{!! Form::hidden('user', $s_msg->id) !!}
							<a href="javascript:formsend{{$key}}.submit()" class="">
								<div class="card message-item hvr-float w-100">
									<div class="card-body">
										<p class="mb-0 text-center">
											To:<span class="ml-1">{{ $s_msg->name }}さん</span>
										</p>
									</div>
								</div>
							</a>
						{!! Form::close() !!}
						</div>
						@php $user_id += [$s_msg->id => $s_msg->name] @endphp
						@endif
					@endforeach
					</div>
				</div>
			@else
				<div class="alert alert-info">
					<p class="mb-0 text-center">メッセージを送った相手はいません</p>
				</div>
			@endif
			</div>

		</div>

	</div><!-- /.user-messages -->
</div>
@endif

{{-- ログインユーザーでない場合に表示されるコンテンツ --}}
@if (Auth::check() && Auth::user()->id != $user->id)
<div class="container-fluid" id="user-page">

	@if (Session::has('send'))
	<div class="alert alert-success text-center">
		{{ session('send') }}
	</div>
	@endif

	<div class="message-from">
		<div class="p-3">
			<div class="card border-dark">
			{{ Form::open(['route' => ['user.sending', $user->id], 'method' => 'post']) }}
				<div class="card-header bg-transparent border-0">
					<span class="text-primary">{{ $user->name }}さん</span><span class="ml-1">にメッセージを送る</span>
				</div>
				<div class="card-body">

					<div class="form-group">
						{!! Form::textarea('message', old('message'), ['class' => 'form-control', 'required']) !!}
					</div>

				</div>
				<div class="card-footer clearfix">
					{!! Form::button('メッセージを送信', ['class' => 'btn btn-outline-dark float-right', 'type' => 'submit']) !!}
				</div>
			{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endif
@endsection

@section('script')
	{{-- user avatar upload sprict --}}
	<script src="https://unpkg.com/file-upload-with-preview"></script>
	<script>
		var upload = new FileUploadWithPreview('myUniqueUploadId')
	</script>
@endsection()