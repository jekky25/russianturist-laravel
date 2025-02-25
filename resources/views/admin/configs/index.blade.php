@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Настройки" />
	<!-- /.content-header -->
	<div class="col-6">
		<div class="col-2 mb-4">
			<a href="{{route('admin.config.create')}}" class="btn btn-block btn-primary">Добавить</a>
		</div>
		<div class="card">
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
					<thead>
						<tr>
							<th>Ид</th>
							<th>Код</th>
							<th>Значение</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach ($configs as $config)
						<tr>
							<td>{{ $config->id }}</td>
							<td>{{ $config->name }}</td>
							<td>{{ $config->value }}</td>
							<td>
								<a class="mr-2 text-success" href="{{route('admin.config.edit', $config->id)}}"><i class="fas fa-pen"></i></a>
								<a class="text-danger action-delete-modal" href="javascript://" data-href="{{route('admin.config.destroy', $config->id)}}" data-bs-toggle="modal" data-bs-target="#formModal"><i class="fas fa-trash-alt"></i></a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div> 
	</div>
</div>
<x-admin.modal-delete />
@endsection