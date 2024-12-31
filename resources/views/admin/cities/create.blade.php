@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Добавление города" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.city.store')}}" class="col-4" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="card-body">
				<x-admin.errors />
				<x-admin.input  :value="old('name')" title="Название" name="name" placeholder="Введите название" />
				<x-admin.input  :value="old('slug')" title="Транскрипция" name="slug" placeholder="Введите значение" />
				<x-admin.inputSelect :value="old('country_id')" :items="($countries)" title="Страна" name="country_id" />
				<x-admin.textarea  :value="old('description')" title="Описание" name="description" placeholder="Введите описание" />
				<x-admin.inputFile  title="Главное изображение" name="image" placeholder="Выберите файл" />
				<div class="form-group row">
					<div class="col-6"></div>
					<div class="col-6">
						<x-admin.input-submit  value="Добавить" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /.content-wrapper -->
@endsection