<div id="editGoalModal" class="modal fade">
	<div class="modal-dialog">
		<form class="modal-content form-horizontal" method="POST" action="/goals/{{ $goal->id }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="PUT">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('labels.goals.modals.edit.close_button') }}"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title">{{ trans('labels.goals.modals.edit.title') }}</h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.label') }}</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="label" value="{{ $goal->label }}" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.amount') }}</label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control" name="amount" value="{{ $goal->amount }}" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.balance') }}</label>
					<div class="col-sm-8">
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control" name="balance" value="{{ $goal->balance }}" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.goal_date') }}</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="goal_date" value="{{ $goal->goal_date }}">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.interest') }}</label>
					<div class="col-sm-8">
						<div class="input-group">
							<input type="text" class="form-control" value="{{ $goal->interest }}">
							<span class="input-group-addon">%</span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('labels.goals.modals.edit.close_button') }}</button>
				<button type="submit" class="btn btn-primary">{{ trans('labels.goals.modals.edit.save_button') }}</button>
			</div>
		</form>
	</div>
</div>