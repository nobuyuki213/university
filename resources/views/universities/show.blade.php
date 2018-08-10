@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')

<div class="university-header container">
	<div class="row mt-3">
		<div class="col px-2">
			<div class="card">

				<img src="card-img-top img-fluid" style="width:100%;height:200px;object-fit:cover;">

			</div>
			<div class="card-body clearfix p-md-4 p-2">
				
				{{-- お気に入り機能実装時の共通レイアウト設置予定行 --}}

				<h4 class="card-title">{{ $university->name }}</h4>


			</div>
		</div>
	</div>
</div>

@endsection

@section('script')

@endsection