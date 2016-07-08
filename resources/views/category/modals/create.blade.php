<div id="addCategoryModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/categories">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('labels.categories.modals.create.close_button') }}"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">{{ trans('labels.categories.modals.create.title') }}</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.categories.properties.label') }}</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="label" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.categories.properties.budgeted') }}</label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control" name="budgeted" required>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.categories.modals.create.close_button') }}</button>
				<button type="submit" class="btn btn-primary">{{ trans('labels.categories.modals.create.save_button') }}</button>
			</div>
		</form>
	</div>
</div>