@for ($i = 0; $i < 5; $i++)
	@if ($i < $params)
		<i class="fas fa-crown fa-lg" style="color:#FFD700;"></i>
	@else
		<i class="fas fa-crown fa-sm" style="color:lightgrey;"></i>
	@endif
@endfor

@switch($params)
    @case(1)
        <div class="small">とても簡単</div>
        @break
    @case(2)
        <div class="small">かんたん</div>
        @break
    @case(3)
        <div class="small">普通</div>
        @break
    @case(4)
        <div class="small">難しい</div>
        @break
    @case(5)
        <div class="small">とても難しい</div>
        @break
    @default
        <div class="small">難易度未設定</div>
@endswitch
