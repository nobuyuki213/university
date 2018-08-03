@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid bg-primary">
    <div class="container">
        <h1 class="text-center text-white">University Select</h1>
    </div>
</div>
<div class="container">
	<div class="universities-index">

		<div class="university card border-0">
			<div class="row">
			@foreach ($universities as $university)
				<div class="col-md-4 mb-4">
					<a href="#" class="">
						<div class="hvr-float university-item card border-primary w-100">
							<div class="card-body text-center">
								<p class="mb-0">{{ $university->name }}</p>
							</div>
						</div>
					</a>
				</div>
			@endforeach
			</div>
		</div>

	</div>
</div>
@endsection