@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Добавление страны" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.country.store')}}" class="col-4" method="post">
			{{ csrf_field() }}
			<div class="card-body">
				<x-admin.errors />
				<x-admin.input  :value="old('countries_name')" title="Имя" name="countries_name" placeholder="Введите имя" />
				<x-admin.input  :value="old('slug')" title="Транскрипция" name="slug" placeholder="Введите значение" />
				<div class="form-group">
					<label for="InputName">Описание</label>
					<textarea class="form-control" name="description" placeholder="Введите описание">{{ old('description') }}</textarea>
				</div>
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