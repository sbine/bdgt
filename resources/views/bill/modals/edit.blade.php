@component('partials.modals.form', [
	'formAction' => route('bills.update', $bill->id),
	'method' => 'PUT',
	'title' => trans('labels.bills.modals.edit.title'),
	'dismissLabel' => trans('labels.bills.modals.edit.close_button'),
	'submitLabel' => trans('labels.bills.modals.edit.save_button')
])
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.bills.properties.label') }}</label>
		<div class="w-2/3">
			<input type="text" class="input-text" name="label" value="{{ $bill->label }}" required>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.bills.properties.amount') }}</label>
		<div class="w-2/3">
			<input type="number" class="input-text" name="amount" step="0.01" min="0" max="10000" value="{{ $bill->amount }}">
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.bills.properties.start_date') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<input type="text" class="input-text datepicker" name="start_date" value="{{ $bill->start_date }}" required>
				<span class="input-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.bills.properties.frequency') }}</label>
		<div class="w-2/3">
			<input type="number" class="input-text" name="frequency" min="7" max="365" value="{{ $bill->frequency }}" required>
		</div>
	</div>
@endcomponent
