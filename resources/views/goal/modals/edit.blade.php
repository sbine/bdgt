@component('partials.modals.form', [
	'id' => 'editGoalModal',
	'formAction' => '/goals/' . $goal->id,
	'method' => 'PUT',
	'title' => trans('labels.goals.modals.edit.title'),
	'dismissLabel' => trans('labels.goals.modals.edit.close_button'),
	'submitLabel' => trans('labels.goals.modals.edit.save_button')
])
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
				<input type="number" class="form-control" name="amount" step="0.01" min="0" max="10000000" value="{{ $goal->amount }}" required>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.goal_date') }}</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input type="text" class="form-control datepicker" name="goal_date" value="{{ $goal->goal_date }}">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('labels.goals.properties.balance') }}</label>
		<div class="col-sm-8">
			<div class="input-group">
				<span class="input-group-addon">$</span>
				<input type="number" class="form-control" name="balance" step="0.01" min="0" max="10000000" value="{{ $goal->balance }}" required>
			</div>
		</div>
	</div>
@endcomponent