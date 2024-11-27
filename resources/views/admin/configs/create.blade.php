@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Добавление настройки" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.config.store')}}" class="col-4" method="post">
			{{ csrf_field() }}
			<div class="card-body">
			@if (!empty ($errors->all()))
				<div class="error text-danger">
					@foreach ($errors->all() as $message)
						<div class="text-xs">{{ $message }}</div>
					@endforeach
				</div>
			@endif
				<x-admin.input  :value="old('name')" title="Имя" name="name" placeholder="Введите имя" />
				<x-admin.input  :value="old('value')" title="Значение" name="value"	placeholder="Введите значение" />
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