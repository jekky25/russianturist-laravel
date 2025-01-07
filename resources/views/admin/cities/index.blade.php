@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Города" />
	<!-- /.content-header -->
	<div class="col-6">
		<div class="col-2 mb-4">
			<a href="{{route('admin.city.create')}}" class="btn btn-block btn-primary">Добавить</a>
		</div>
		<div class="card">
			<div class="card-body table-responsive p-0">
				<table class="table table-hover text-nowrap">
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
					@foreach ($cities as $city)
						<tr>
							<td>{{ $city->id }}</td>
							<td>{{ $city->name }} @if (!empty($city->country))(<a href="{{route('admin.country.edit', $city->country->id)}}">{{ $city->country->name }}</a>)@endif</td>
							<td>{{ $city->slug }}</td>
							<td>@if (!empty($city->pictures))
									@foreach ($city->pictures as $picture)
										<span class="max-w-100px"><img class="w-100" alt="" title="" src="{{ asset($picture->imagePath) }}" /></span>
									@endforeach
								@endif
							</td>
							<td>
								<a class="mr-2 text-success" href="{{route('admin.city.edit', $city->id)}}"><i class="fas fa-pen"></i></a>
								<a class="text-danger action-delete-modal" href="javascript://" data-href="{{route('admin.city.destroy', $city->id)}}" data-bs-toggle="modal" data-bs-target="#formModal"><i class="fas fa-trash-alt"></i></a>
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