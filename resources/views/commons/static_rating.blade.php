@for ($i = 0; $i < 5; $i++)
	@if ($i < $params)
		<i class="fas fa-star fa-lg" style="color:#ff9900;"></i>
	@else
		<i class="fas fa-star fa-lg" style="color:lightgrey;"></i>
	@endif
@endfor