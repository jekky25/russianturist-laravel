@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Редактирование страны" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.country.update', $country->id)}}" class="col-4" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			@method('PATCH')
			<div class="card-body">
				<x-admin.errors />			
				<x-admin.input  :value="old('name', $country->name)" title="Имя" name="name" placeholder="Введите имя" />
				<x-admin.input  :value="old('slug', $country->slug)" title="Транскрипция" name="slug" placeholder="Введите значение" />
				<x-admin.textarea  :value="old('description', $country->description)" title="Описание" name="description" placeholder="Введите описание" />
				<div class="form-group">
					<label for="exampleInputFile">Главное изображение</label>
					@if (!empty($country->image))<div class="w-50 mb-2"><img class="w-50" alt="" title"" src="{{ asset('storage/' . $country->imagePath) }}" /></div>@endif
					<div class="input-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="exampleInputFile" name="image">
							<label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
						</div>
						<div class="input-group-append">
							<span class="input-group-text">Загрузка</span>
						</div>
					</div>
				</div>
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
<!-- /.content-wrapper -->
@endsection