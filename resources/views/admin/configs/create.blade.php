@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Добавление настройки</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active">Настройки</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
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
				<div class="form-group">
					<label for="InputName">Имя</label>
					<input type="text" name="name" class="form-control" id="InputName" placeholder="Введите имя">
				</div>
				<div class="form-group">
					<label for="InputValue">Значение</label>
					<input type="text" name="value" class="form-control" id="InputValue" placeholder="Введите значение">
				</div>
				<div class="form-group row">
					<div class="col-6"></div>
					<div class="col-6">
						<input type="submit" class="btn btn-block btn-primary" value="Добавить">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- /.content-wrapper -->
@endsection