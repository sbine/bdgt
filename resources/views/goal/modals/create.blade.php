@component('partials.modals.form', [
	'formAction' => route('goals.store'),
	'title' => trans('labels.goals.modals.create.title'),
	'dismissLabel' => trans('labels.goals.modals.create.close_button'),
	'submitLabel' => trans('labels.goals.modals.create.save_button')
])
	<input type="hidden" name="start_date" value="{{ date('Y-m-d') }}">
	<input type="hidden" name="balance" value="0">
	<div class="form-row">
		<label class="form-row--label">{{ trans('labels.goals.properties.label') }}</label>
		<div class="form-row--input">
			<input type="text" class="input-text" name="label" required>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row--label">{{ trans('labels.goals.properties.amount') }}</label>
		<div class="form-row--input input-addon--start">
			<span class="input-addon">$</span>
			<input type="number" class="input-text" name="amount" step="0.01" min="0" max="10000000" required>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row--label">{{ trans('labels.goals.properties.goal_date') }}</label>
		<div class="form-row--input">
			<input-datepicker name="goal_date"></input-datepicker>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row--label">{{ trans('labels.goals.properties.balance') }}</label>
		<div class="form-row--input">
			<input type="number" class="input-text" name="balance" step="0.01" min="0" max="10000000">
		</div>
	</div>
@endcomponent
