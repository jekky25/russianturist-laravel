@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Редактирование страны" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.country.update', $country->id)}}" class="col-4" method="post">
			{{ csrf_field() }}
			@method('PATCH')
			<div class="card-body">
				<x-admin.errors />			
				<x-admin.input  :value="old('name', $country->name)" title="Имя" name="name" placeholder="Введите имя" />
				<x-admin.input  :value="old('slug', $country->slug)" title="Транскрипция" name="slug" placeholder="Введите значение" />
				<x-admin.textarea  :value="old('description', $country->description)" title="Описание" name="description" placeholder="Введите описание" />
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