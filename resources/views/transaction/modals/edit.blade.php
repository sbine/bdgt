<div id="editTransactionModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/transactions">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PUT">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('labels.transactions.modals.edit.close_button') }}"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">{{ trans('labels.transactions.modals.edit.title') }}</h4>
			</div>
			<div class="modal-body">
				@include('transaction._form')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.transactions.modals.edit.close_button') }}</button>
				<button type="submit" class="btn btn-primary">{{ trans('labels.transactions.modals.edit.save_button') }}</button>
			</div>
		</form>
	</div>
</div>