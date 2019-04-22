@component('partials.modals.form', [
	'formAction' => route('accounts.update', $account->id),
	'method' => 'PUT',
	'title' => trans('labels.accounts.modals.edit.title'),
	'dismissLabel' => trans('labels.accounts.modals.edit.close_button'),
	'submitLabel' => trans('labels.accounts.modals.edit.save_button')
])
	<div class="form-row">
		<label class="form-row--label">{{ trans('labels.accounts.properties.name') }}</label>
		<div class="form-row--input">
			<input type="text" class="input-text" name="name" value="{{ $account->name }}" required>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row--label">{{ trans('labels.accounts.properties.balance') }}</label>
		<div class="form-row--input input-addon--start">
			<span class="input-addon">$</span>
			<input type="text" class="input-text" name="balance" value="{{ $account->balance }}">
		</div>
	</div>
	<div class="form-row">
		<label class="form-row--label">{{ trans('labels.accounts.properties.interest') }}</label>
		<div class="form-row--input input-addon--end">
			<input type="text" class="input-text" name="interest" value="{{ $account->interest }}">
			<span class="input-addon">%</span>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row--label">{{ trans('labels.accounts.properties.date_opened') }}</label>
		<div class="form-row--input">
			<input-datepicker name="date_opened" value="{{ $account->date_opened }}"></input-datepicker>
		</div>
	</div>
@endcomponent
