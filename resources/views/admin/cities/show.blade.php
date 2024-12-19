@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Wrapper. Contains page content -->
	<x-admin.title-block title="Редактирование город" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.city.store')}}" class="col-4" method="post">
			{{ csrf_field() }}
			<div class="card-body">
			@if (!empty ($errors->all()))
				<div class="error text-danger">
					@foreach ($errors->all() as $message)
						<div class="text-xs">{{ $message }}</div>
					@endforeach
				</div>
			@endif				
				<div class="form-group">
					<label for="InputName">Код</label>
					<input type="text" name="name" class="form-control" id="InputName" value="{{ old('name', $config->name) }}" placeholder="Введите имя">
				</div>
				<div class="form-group">
					<label for="InputValue">Значение</label>
					<input type="text" name="value" class="form-control" id="InputValue" value="{{ old('value', $config->value) }}" placeholder="Введите значение">
				</div>
				<div class="form-group row">
					<div class="col-6"></div>
					<div class="col-6">
						<input type="submit" class="btn btn-block btn-primary" value="Сохранить">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /.content-wrapper -->
@endsection