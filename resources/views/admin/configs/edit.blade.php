@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Редактирование настройки" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.config.update', $config->id)}}" class="col-4" method="post">
			{{ csrf_field() }}
			@method('PATCH')
			<div class="card-body">
			@if (!empty ($errors->all()))
				<div class="error text-danger">
					@foreach ($errors->all() as $message)
						<div class="text-xs">{{ $message }}</div>
					@endforeach
				</div>
			@endif				
				<x-admin.input  :value="old('name', $config->name)" title="Имя" name="name" placeholder="Введите имя" />
				<x-admin.input  :value="old('value', $config->value)" title="Значение" name="value"	placeholder="Введите значение" />
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