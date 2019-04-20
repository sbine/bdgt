@component('partials.modals.form', [
	'formAction' => route('accounts.store'),
	'title' => trans('labels.accounts.modals.create.title'),
	'dismissLabel' => trans('labels.accounts.modals.create.close_button'),
	'submitLabel' => trans('labels.accounts.modals.create.save_button')
])
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.name') }}</label>
		<div class="w-2/3">
			<input type="text" class="input-text" name="name" required>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.balance') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<span class="input-addon">$</span>
				<input type="text" class="input-text" name="balance">
			</div>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.interest') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<input type="text" class="input-text" name="interest">
				<span class="input-addon">%</span>
			</div>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.accounts.properties.date_opened') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<input type="text" class="input-text datepicker" name="date_opened">
				<span class="input-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
	</div>
@endcomponent
