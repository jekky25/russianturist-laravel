@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Настройки</h1>
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
<!-- modal -->
	<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form class="modal-form" action="#" method="post">
				{{ csrf_field() }}
				@method('DELETE')
				<div class="modal-content">
					<div class="modal-header">
					<h5></h5>
					<button type="button" class="btn-close action-close" data-bs-dismiss="modal" aria-label="Закрыть"><i class="fas fa-times"></i></button>
				</div>
				<div class="modal-body">
					<p class="text-center">Удалить объект?</p>
				</div>
				<div class="modal-footer">
					<div class="row">
						<div class="col-6">
							<button type="button" class="btn btn-secondary action-close" data-bs-dismiss="modal">Нет</button>
						</div>
						<div class="col-6">
							<button type="submit" class="btn btn-primary">Да</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@push('scripts')
<script>
$(document).ready(function(){
	var modal = $('#formModal');
	var modalForm = $('.modal-form', modal);
	var	close = $('.action-close');
	var actionDeleteModal = $('.action-delete-modal');
	
	refreshData = function(e){
		setModalUrl(e.data('href'));
	};

	closeModal = function(){
		modal.modal('hide');
		return false;
	};

	openModal =  function(){
		modal.modal('show');
		refreshData($(this));
	};

	setModalUrl = function(url){
		if (url == 'undefined') return false;
		modalForm.attr('action', url);
	};

	close.click(closeModal);
	actionDeleteModal.click(openModal);

});	
</script>
@endpush
@endsection