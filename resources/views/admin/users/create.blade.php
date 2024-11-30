@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Добавление пользователя" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.user.store')}}" class="col-4" method="post">
			{{ csrf_field() }}
			<div class="card-body">
				<x-admin.errors />	
				<x-admin.input  :value="old('name')" title="Имя" name="name" placeholder="Введите имя" />
				<x-admin.input  :value="old('email')" title="Емайл" name="email" placeholder="Введите емайл" />
				<x-admin.input  :value="old('password')" title="Пароль" name="password" placeholder="Введите пароль" />
				<div class="form-group w-50">
					<label>Роль</label>
					<select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="role">
						@foreach ($roles as $id => $role)
							<option {{ $id == old('role') ? 'selected="selected"' : '' }} data-select2-id="{{ $id }}" value="{{ $id }}">{{ $role }}</option>
						@endforeach
					</select>
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