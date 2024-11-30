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