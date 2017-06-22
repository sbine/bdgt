@component('partials.modals.form', [
	'id' => 'editTransactionModal',
	'formAction' => '/transactions',
	'method' => 'PUT',
	'title' => trans('labels.transactions.modals.edit.title'),
	'dismissLabel' => trans('labels.transactions.modals.edit.close_button'),
	'submitLabel' => trans('labels.transactions.modals.edit.save_button')
])
	@include('transaction._form')
@endcomponent