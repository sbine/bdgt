@component('partials.modals.form', [
	'formAction' => route('goals.update', $goal->id),
	'method' => 'PUT',
	'title' => trans('labels.goals.modals.edit.title'),
	'dismissLabel' => trans('labels.goals.modals.edit.close_button'),
	'submitLabel' => trans('labels.goals.modals.edit.save_button')
])
	<div class="form-row">
		<label class="form-row__label">{{ trans('labels.goals.properties.label') }}</label>
		<div class="form-row__input">
			<input type="text" class="input-text" name="label" value="{{ $goal->label }}" required>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row__label">{{ trans('labels.goals.properties.amount') }}</label>
		<div class="form-row__input input-addon--start">
			<span class="input-addon">$</span>
			<input type="number" class="input-text" name="amount" step="0.01" min="0" max="10000000" value="{{ round($goal->amount, 2) }}" required>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row__label">{{ trans('labels.goals.properties.goal_date') }}</label>
		<div class="form-row__input input-addon--end">
			<input-datepicker name="goal_date" value="{{ $goal->goal_date }}"></input-datepicker>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row__label">{{ trans('labels.goals.properties.balance') }}</label>
		<div class="form-row__input input-addon--start">
			<span class="input-addon">$</span>
			<input type="number" class="input-text" name="balance" step="0.01" min="0" max="10000000" value="{{ round($goal->balance, 2) }}" required>
		</div>
	</div>
@endcomponent
