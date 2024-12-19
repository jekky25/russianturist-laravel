<div class="form-group">
	<label for="exampleInput_{{ $name }}">{{ $title }}</label>
	@if (!empty($image))
	@if ($image instanceof \Illuminate\Database\Eloquent\Collection && $image->count() > 0)
		@foreach($image as $_image)
			<div class="w-50 mb-2"><img class="w-50" alt="" title="" src="{{ asset($_image->imagePath) }}" /></div>
		@endforeach
	@else
	<div class="w-50 mb-2"><img class="w-50" alt="" title="" src="{{ asset($imagePath) }}" /></div>
	@endif
	@endif
	<div class="input-group">
		<div class="custom-file">
			<input type="file" class="custom-file-input" id="exampleInput_{{ $name }}" name="{{ $name }}">
			<label class="custom-file-label" for="exampleInput_{{ $name }}">{{ $placeholder }}</label>
		</div>
		<div class="input-group-append">
			<span class="input-group-text">Загрузка</span>
		</div>
	</div>
</div>