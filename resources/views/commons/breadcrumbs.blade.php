@if (count($breadcrumbs))

	<nav aria-label="breadcrumbs-list" class="px-md-0 px-3">
		<ol class="breadcrumb container px-md-3 px-0" style="overflow-x:auto;display:-webkit-box;">
			@foreach ($breadcrumbs as $breadcrumb)

				@if ($breadcrumb->url && !$loop->last)
					<li class="breadcrumb-item">
						<a href="{{ $breadcrumb->url }}">{{ $breadcrumb->icon ?? '' }} {{ $breadcrumb->title }}</a>
					</li>
				@else
		 			<li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->icon ?? '' }} {{ $breadcrumb->title }}</li>
				@endif

			@endforeach
		</ol>
	</nav>

@endif