@component('partials.modals.form', [
	'id' => 'deleteTransactionModal',
	'formAction' => '/transactions',
	'method' => 'DELETE',
	'title' => trans('labels.transactions.modals.delete.title'),
	'dismissLabel' => trans('labels.transactions.modals.delete.close_button'),
	'submitLabel' => trans('labels.transactions.modals.delete.save_button')
])
	<p class="text-danger">{{ trans('labels.transactions.modals.delete.text') }}</p>
@endcomponent