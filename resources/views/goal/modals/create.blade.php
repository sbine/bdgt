@component('partials.modals.form', [
	'id' => 'addGoalModal',
	'formAction' => '/goals',
	'title' => trans('labels.goals.modals.create.title'),
	'dismissLabel' => trans('labels.goals.modals.create.close_button'),
	'submitLabel' => trans('labels.goals.modals.create.save_button')
])
	<input type="hidden" name="start_date" value="{{ date('Y-m-d') }}">
	<input type="hidden" name="balance" value="0">
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
				<input type="number" class="form-control" name="amount" step="0.01" min="0" max="10000000" required>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.goal_date') }}</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input type="text" class="form-control datepicker" name="goal_date">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.balance') }}</label>
		<div class="col-sm-8">
			<input type="number" class="form-control" name="balance" step="0.01" min="0" max="10000000">
		</div>
	</div>
@endcomponent