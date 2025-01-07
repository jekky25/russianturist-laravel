@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Отели" />
	<!-- /.content-header -->
	<div class="col-12">
		<div class="col-2 mb-4">
			<a href="{{route('admin.hotel.create')}}" class="btn btn-block btn-primary">Добавить</a>
		</div>
		<div class="card">
			<div class="card-body table-responsive p-0">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Ид</th>
							<th>Название</th>
							<th>Код</th>
							<th>Изображение</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach ($hotels as $hotel)
						<tr>
							<td>{{ $hotel->id }}</td>
							<td>{{ $hotel->name }}</td>
							<td>{{ $hotel->slug }}</td>
							<td>@if (!empty($hotel->pictures))
								@foreach ($hotel->pictures as $picture)
									<span class="max-w-100px"><img class="w-100" alt="" title="" src="{{ asset($picture->imagePath) }}" /></span>
								@endforeach
							@endif
						</td>
							<td class="text-nowrap">
								<a class="mr-2 text-success" href="{{route('admin.hotel.edit', $hotel->id)}}"><i class="fas fa-pen"></i></a>
								<a class="text-danger action-delete-modal" href="javascript://" data-href="{{route('admin.hotel.destroy', $hotel->id)}}" data-bs-toggle="modal" data-bs-target="#formModal"><i class="fas fa-trash-alt"></i></a>
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