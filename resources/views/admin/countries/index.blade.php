@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Страны" />
	<!-- /.content-header -->
	<div class="col-6">
		<div class="col-2 mb-4">
			<a href="{{route('admin.country.create')}}" class="btn btn-block btn-primary">Добавить</a>
		</div>
		<div class="card">
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
					<thead>
						<tr>
							<th>Ид</th>
							<th>Код</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach ($countries as $country)
						<tr>
							<td>{{ $country->countries_id }}</td>
							<td>{{ $country->countries_name }}</td>
							<td>
								<a class="mr-2 text-success" href="{{route('admin.country.edit', $country->countries_id)}}"><i class="fas fa-pen"></i></a>
								<a class="text-danger action-delete-modal" href="javascript://" data-href="{{route('admin.country.destroy', $country->countries_id)}}" data-bs-toggle="modal" data-bs-target="#formModal"><i class="fas fa-trash-alt"></i></a>
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