<div class="jumbotron jumbotron-fluid">
	<div class="container-fluid" id="user-page">
		<div class="user-header mx-auto">
			<div class="media">
				<a href="#" class="mr-3">
					<img src="..." class="img-fluid rounded-circle" alt="user-icon" style="height:250px;width:250px;">
				</a>
				<div class="media-body">
					<h5 class="mt-0">{{ $user->name }}</h5>
					メディアのコンテンツ...
				</div><!-- /.media-body -->
			</div><!-- /.media -->

			@if (Auth::check() && Auth::user()->id == $user->id)
			<ul class="nav nav-pills justify-content-center mt-4">
				<li class="nav-item"><a href="{{ route('user.show', ['id' => Auth::user()->id]) }}" class="nav-link{{ Request::is('user/*') ? ' active' : '' }}"><i class="far fa-envelope"></i></a></li>
				<li class="nav-item"><a href="#" class="nav-link">コメント</a></li>
				<li class="nav-item"><a href="#" class="nav-link">お気に入り</a></li>
			</ul>
			@endif

		</div>
	</div>
</div>