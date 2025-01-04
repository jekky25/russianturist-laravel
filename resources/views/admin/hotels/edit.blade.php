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
				<x-admin.inputSelect :value="old('stars', $hotel->stars)" :items="($stars)" title="Рейтинг" name="stars" />
				<x-admin.inputSelect :value="old('city_id', $hotel->city_id)" :items="($cities)" title="Город" name="city_id" />
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