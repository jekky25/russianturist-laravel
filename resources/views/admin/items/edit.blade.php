@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<x-admin.title-block title="Редактирование статьи" />
	<!-- /.content-header -->
	<div class="col-12">
		<form action="{{route('admin.item.update', $item->id)}}" class="col-4" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			@method('PATCH')
			<div class="card-body">
				<x-admin.errors />			
				<x-admin.input :value="old('name', $item->name)" title="Название" name="name" placeholder="Введите название" />
				<x-admin.textarea :value="old('description', $item->description)" title="Описание" name="description" placeholder="Введите описание" />
				<x-admin.inputFile :image="$item->fotos" title="Главное изображение" name="image" placeholder="Выберите файл" />
				<div class="form-group row">
					<div class="col-6"></div>
					<div class="col-6">
						<x-admin.input-submit  value="Сохранить" />
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<x-admin.modal-delete />
<!-- /.content-wrapper -->
@endsection