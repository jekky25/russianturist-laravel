@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Статьи" />
	<!-- /.content-header -->
	<div class="col-12">
		<div class="col-2 mb-4">
			<a href="{{route('admin.item.create')}}" class="btn btn-block btn-primary">Добавить</a>
		</div>
		<div class="card">
			<div class="card-body table-responsive p-0">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Ид</th>
							<th>Название</th>
							<th>Изображение</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach ($items as $item)
						<tr>
							<td>{{ $item->id }}</td>
							<td>{{ $item->name }}</td>
							<td>@if (!empty($item->fotos))
								@foreach ($item->fotos as $foto)
									<span class="max-w-100px"><img class="w-100" alt="" title="" src="{{ asset($foto->imagePath) }}" /></span>
								@endforeach
							@endif
						</td>
							<td class="text-nowrap">
								<a class="mr-2 text-success" href="{{route('admin.item.edit', $item->id)}}"><i class="fas fa-pen"></i></a>
								<a class="text-danger action-delete-modal" href="javascript://" data-href="{{route('admin.item.destroy', $item->id)}}" data-bs-toggle="modal" data-bs-target="#formModal"><i class="fas fa-trash-alt"></i></a>
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