<div id="addGoalModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/goals">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="start_date" value="{{ date('Y-m-d') }}">
			<input type="hidden" name="balance" value="0">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('labels.goals.modals.create.close_button') }}"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">{{ trans('labels.goals.modals.create.title') }}</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.label') }}</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="label" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.amount') }}</label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control" name="amount" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.goal_date') }}</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="goal_date">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.interest') }}</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" class="form-control" name="interest">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.goals.modals.create.close_button') }}</button>
				<button type="submit" class="btn btn-primary">{{ trans('labels.goals.modals.create.save_button') }}</button>
			</div>
		</form>
	</div>
</div>