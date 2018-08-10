@extends('layouts.app')

@section('stylesheet')
	<!--breadcrumbs Css -->
	<link href="{{ asset('css/bread_style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/reset.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="jumbotron jumbotron-fluid bg-primary">
	<div class="container">
		<ol class="cd-breadcrumb triangle">
			<li><em>大学を選択</em></li>
			<li><em>レビューを書く</em></li>
			<li><em>レビューを確認</em></li>
			<li class="current"><em>投稿完了</em></li>
		</ol>
	</div>
</div>
<div class="container text-center">
	@if (session()->has('complete'))
		<div class="alert alert-success col-md-8 mx-auto text-center">
			{{ session('complete') }}
		</div>
	@endif
	<h1 class="display-1"><i class="far fa-handshake fa-3x"></i></h1>
	<h1 class="display-1">Thank you</h1>
</div>
@endsection

@section('script')

@endsection