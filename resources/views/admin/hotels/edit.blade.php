@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Редактирование отеля" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.hotel.update', $hotel->id)}}" class="col-4" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			@method('PATCH')
			<div class="card-body">
				<x-admin.errors />			
				<x-admin.input  :value="old('name', $hotel->name)" title="Название" name="name" placeholder="Введите название" />
				<x-admin.input  :value="old('slug', $hotel->slug)" title="Транскрипция" name="slug" placeholder="Введите значение" />
				<div class="form-group w-100">
					<label>Рейтинг</label>
					<select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="stars">
						<option value="0">Выберите</option>
						@foreach ($stars as $star)
							<option {!! $star == old('stars', $hotel->stars) ? 'selected="selected"' : '' !!} data-select2-id="{{ $star }}" value="{{ $star }}">{{ $star }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group w-100">
					<label>Город</label>
					<select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="town_id">
						<option value="0">Выберите</option>
						@foreach ($cities as $city)
							<option {!! $city->id == old('town_id', $hotel->town_id) ? 'selected="selected"' : '' !!} data-select2-id="{{ $city->id }}" value="{{ $city->id }}">{{ $city->name }}</option>
						@endforeach
					</select>
				</div>
				<x-admin.textarea  :value="old('description', $hotel->description)" title="Описание" name="description" placeholder="Введите описание" />
				<x-admin.inputFile  :image="$hotel->fotos" title="Главное изображение" name="image" placeholder="Выберите файл" />
				<div class="form-group row">
					<div class="col-6"></div>
					<div class="col-6">
						<x-admin.input-submit  value="Сохранить" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<x-admin.modal-delete />
<!-- /.content-wrapper -->
@endsection