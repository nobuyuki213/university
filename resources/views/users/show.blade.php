@extends('layouts.app')

@section('content')
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

			<ul class="nav nav-pills justify-content-center mt-4">
				<li class="nav-item"><a href="#" class="nav-link active">メッセージ</a></li>
				<li class="nav-item"><a href="#" class="nav-link">コメント</a></li>
				<li class="nav-item"><a href="#" class="nav-link">お気に入り</a></li>
			</ul>

		</div>
	</div>
</div>
<div class="container-fluid" id="user-page"">
	
</div>
@endsection