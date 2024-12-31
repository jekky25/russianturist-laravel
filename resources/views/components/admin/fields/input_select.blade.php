<div class="form-group w-100">
	<label for="InputName_{{ $name }}">{{ $title }}</label>
	<select id="InputName_{{ $name }}" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="{{ $name }}">
		<option value="0">Выберите</option>
		@if (!empty($items))
		@foreach ($items as $item)
			<option {!! $item->id == $value ? 'selected="selected"' : '' !!} data-select2-id="{{ $item->id }}" value="{{ $item->id }}">{{ $item->name }}</option>
		@endforeach
		@endif
	</select>
</div>