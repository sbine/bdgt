<div id="editAccountModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="{{ route('accounts.update', $account->id) }}">
			@csrf
			@method('PUT')

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('labels.accounts.modals.edit.close_button') }}"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">{{ trans('labels.accounts.modals.edit.title') }}</h3>
			</div>
			<div class="modal-body">
				<div class="flex items-center">
					<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.name') }}</label>
					<div class="w-2/3">
						<input type="text" class="input-text" name="name" value="{{ $account->name }}" required>
					</div>
				</div>
				<div class="flex items-center">
					<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.balance') }}</label>
					<div class="w-2/3">
						<div class="flex items-center">
							<span class="input-addon">$</span>
							<input type="text" class="input-text" name="balance" value="{{ $account->balance }}">
						</div>
					</div>
				</div>
				<div class="flex items-center">
					<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.interest') }}</label>
					<div class="w-2/3">
						<div class="flex items-center">
							<input type="text" class="input-text" name="interest" value="{{ $account->interest }}">
							<span class="input-addon">%</span>
						</div>
					</div>
				</div>
				<div class="flex items-center">
					<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.date_opened') }}</label>
					<div class="w-2/3">
						<div class="flex items-center">
							<input type="text" class="input-text datepicker" name="date_opened" value="{{ $account->date_opened }}">
							<span class="input-addon"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.accounts.modals.edit.close_button') }}</button>
				<button type="submit" class="btn btn-primary">{{ trans('labels.accounts.modals.edit.save_button') }}</button>
			</div>
		</form>
	</div>
</div>
