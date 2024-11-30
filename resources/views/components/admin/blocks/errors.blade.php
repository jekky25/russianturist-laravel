@if (!empty ($errors->all()))
	<div class="error text-danger">
		@foreach ($errors->all() as $message)
			<div class="text-xs">{{ $message }}</div>
		@endforeach
	</div>
@endif