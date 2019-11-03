@component('partials.modals.form', [
	'formAction' => route('bills.store'),
	'title' => trans('labels.bills.modals.create.title'),
	'dismissLabel' => trans('labels.bills.modals.create.close_button'),
	'submitLabel' => trans('labels.bills.modals.create.save_button')
])
	<div class="form-row">
		<label class="form-row__label">{{ trans('labels.bills.properties.label') }}</label>
		<div class="form-row__input">
			<input type="text" class="input-text" name="label" required>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row__label">{{ trans('labels.bills.properties.amount') }}</label>
		<div class="form-row__input input-addon--start">
			<span class="input-addon">$</span>
			<input type="number" class="input-text" name="amount" step="0.01" min="0" max="10000" required>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row__label">{{ trans('labels.bills.properties.start_date') }}</label>
		<div class="form-row__input">
			<input-datepicker name="start_date" required></input-datepicker>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row__label">{{ trans('labels.bills.properties.frequency') }}</label>
		<div class="form-row__input">
			<input type="number" class="input-text" name="frequency" min="7" max="365" required>
		</div>
	</div>
@endcomponent
