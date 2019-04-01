@component('partials.modals.form', [
	'id' => 'addBillModal',
	'formAction' => '/bills',
	'title' => trans('labels.bills.modals.create.title'),
	'dismissLabel' => trans('labels.bills.modals.create.close_button'),
	'submitLabel' => trans('labels.bills.modals.create.save_button')
])
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.bills.properties.label') }}</label>
		<div class="w-2/3">
			<input type="text" class="input-text" name="label" required>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.bills.properties.amount') }}</label>
		<div class="w-2/3">
			<input type="number" class="input-text" name="amount" step="0.01" min="0" max="10000">
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.bills.properties.start_date') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<input type="text" class="input-text datepicker" name="start_date" required>
				<span class="input-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.bills.properties.frequency') }}</label>
		<div class="w-2/3">
			<input type="number" class="input-text" name="frequency" min="7" max="365" required>
		</div>
	</div>
@endcomponent
