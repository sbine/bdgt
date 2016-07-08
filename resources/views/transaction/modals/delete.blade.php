<div id="deleteTransactionModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/transactions">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="DELETE">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('labels.transactions.modals.delete.close_button') }}"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">{{ trans('labels.transactions.modals.delete.title') }}</h4>
			</div>
			<div class="modal-body">
				<p class="text-danger">{{ trans('labels.transactions.modals.delete.text') }}.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.transactions.modals.delete.close_button') }}</button>
				<button type="submit" class="btn btn-primary">{{ trans('labels.transactions.modals.delete.save_button') }}</button>
			</div>
		</form>
	</div>
</div>