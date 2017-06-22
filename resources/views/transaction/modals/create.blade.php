@component('partials.modals.form', [
	'id' => 'addTransactionModal',
	'formAction' => '/transactions',
	'title' => trans('labels.transactions.modals.create.title'),
	'dismissLabel' => trans('labels.transactions.modals.create.close_button'),
	'submitLabel' => trans('labels.transactions.modals.create.save_button')
])
	@include('transaction._form', [
		'useDefaults' => true
	])
@endcomponent