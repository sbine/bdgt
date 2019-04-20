<div id="addAccountModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="{{ route('accounts.store') }}">
			@csrf

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('labels.accounts.modals.create.close_button') }}"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">{{ trans('labels.accounts.modals.create.title') }}</h4>
			</div>
			<div class="modal-body">
				<div class="flex items-center">
					<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.name') }}</label>
					<div class="w-2/3">
						<input type="text" class="input-text" name="name" required>
					</div>
				</div>
				<div class="flex items-center">
					<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.balance') }}</label>
					<div class="w-2/3">
						<div class="flex items-center">
							<span class="input-addon">$</span>
							<input type="text" class="input-text" name="balance">
						</div>
					</div>
				</div>
				<div class="flex items-center">
					<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.interest') }}</label>
					<div class="w-2/3">
						<div class="flex items-center">
							<input type="text" class="input-text" name="interest">
							<span class="input-addon">%</span>
						</div>
					</div>
				</div>
				<div class="flex items-center">
					<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.date_opened') }}</label>
					<div class="w-2/3">
						<div class="flex items-center">
							<input type="text" class="input-text datepicker" name="date_opened">
							<span class="input-addon"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="button" data-dismiss="modal">{{ trans('labels.accounts.modals.create.close_button') }}</button>
				<button type="submit" class="class="button button--primary">{{ trans('labels.accounts.modals.create.save_button') }}</button>
			</div>
		</form>
	</div>
</div>
