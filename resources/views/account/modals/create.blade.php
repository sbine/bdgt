<div id="addAccountModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/accounts">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('labels.accounts.modals.create.close_button') }}"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">{{ trans('labels.accounts.modals.create.title') }}</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.accounts.properties.name') }}</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="name" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.accounts.properties.balance') }}</label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control" name="balance">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.accounts.properties.interest') }}</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" class="form-control" name="interest">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.accounts.properties.date_opened') }}</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" class="form-control datepicker" name="date_opened">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.accounts.modals.create.close_button') }}</button>
				<button type="submit" class="btn btn-primary">{{ trans('labels.accounts.modals.create.save_button') }}</button>
			</div>
		</form>
	</div>
</div>