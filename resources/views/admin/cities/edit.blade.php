@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Редактирование города" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.city.update', $city->id)}}" class="col-4" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			@method('PATCH')
			<div class="card-body">
				<x-admin.errors />
				<x-admin.input  :value="old('name', $city->name)" title="Имя" name="name" placeholder="Введите имя" />
				<x-admin.input  :value="old('slug', $city->slug)" title="Транскрипция" name="slug" placeholder="Введите значение" />
				<x-admin.inputSelect :value="old('country_id', $city->country_id)" :items="($countries)" title="Страна" name="country_id" />
				<x-admin.textarea  :value="old('description', $city->description)" title="Описание" name="description" placeholder="Введите описание" />
				<x-admin.inputFile  :image="$city->fotos" title="Главное изображение" name="image" placeholder="Выберите файл" />
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