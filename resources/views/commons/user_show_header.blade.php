<div class="jumbotron jumbotron-fluid">
	<div class="container-fluid" id="user-page">
		<div class="user-header">
			<div class="row">
				<div class="media col-lg-8 offset-lg-2" style="position:relative;">
					<!-- user avatar image -->
					@if ($user->avatar != 'default.jpg')
					<a href="#" class="mr-3" style="max-width:15%;">
						<img src="{{ asset('storage/avatars/'. $user->id . '/' . $user->avatar) }}" class="img-fluid rounded-circle" alt="user-icon" style="height:100px;width:100px;">
					</a>
					@else
					<a href="#" class="mr-3" style="max-width:15%;">
						<img src="{{ asset('storage/avatars/' . $user->avatar) }}" class="img-fluid rounded-circle" alt="user-icon">
					</a>
					@endif
					@if (Auth::check() && Auth::user()->id == $user->id)
					<!-- user avatar change ボタン ログインユーザー本人のみ表示-->
					<span class="text-secondary" data-toggle="modal" data-target="#UserIconModal" style="position:absolute;bottom:-1vmin;left:3%;">
						<i class="fas fa-plus-circle bg-light rounded-circle" style="font-size:calc(0.6rem + 2vmin)"></i>
					</span>
					@endif

					<div class="media-body">
						<h5 class="mt-0">{{ $user->name }}</h5>
					</div><!-- /.media-body -->
				</div><!-- /.media -->
			</div>

			@if (Auth::check() && Auth::user()->id == $user->id)
			<ul class="nav nav-pills justify-content-center mt-4">
				<li class="nav-item">
					<a href="{{ route('user.show', ['id' => Auth::user()->id]) }}" class="nav-link{{ Request::is('user/' . $user->id) || Request::is('user/*/messages') ? ' active' : '' }}">
						<i class="far fa-envelope"></i>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('user.reviews', ['id' => Auth::user()->id]) }}" class="nav-link{{ Request::is('user/*/reviews') ? ' active' : '' }}">
						<i class="far fa-comment"></i>
					</a>
				</li>
			</ul>
			@endif

		</div>
	</div>
</div>

@if (Auth::check() && Auth::user()->id == $user->id)
<!-- user avatar change モーダル ログインユーザー本人の未表示-->
<div class="modal fade" id="UserIconModal" tabindex="-1" role="dialog" aria-labelledby="UserIconModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="UserIconModalLabel">アイコンの画像を変える</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
					<span aria-hidden="true"><i class="fas fa-times"></i></span>
				</button>
			</div>
			<div class="modal-body">

				{!! Form::open(['route' => 'avatar.update', 'files' => 'true']) !!}
					<div class="form-group mb-0">
						<div class="custom-file-container" data-upload-id="myUniqueUploadId">
							<label>画像をアップロード <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">[取消]</a></label>

							<label class="custom-file-container__custom-file" >
								{!! Form::file('avatar', ['class' => 'custom-file-container__custom-file__custom-file-input']) !!}
								<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
								<span class="custom-file-container__custom-file__custom-file-control"></span>
							</label>
							<div class="custom-file-container__image-preview"></div>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">閉じる</button>
							{!! Form::button('変更する', ['type' => 'submit', 'class' => 'btn btn-primary btn-lg']) !!}
						</div><!-- /.modal-footer -->
					</div>
				{!! Form::close() !!}

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endif