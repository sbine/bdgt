@component('partials.modals.form', [
	'id' => 'deleteBillModal',
	'formAction' => '/bills/' . $bill->id,
	'method' => 'DELETE',
	'title' => trans('labels.bills.modals.delete.title'),
	'dismissLabel' => trans('labels.bills.modals.delete.close_button'),
	'submitLabel' => trans('labels.bills.modals.delete.save_button')
])
	<p class="text-danger">{{ trans('labels.bills.modals.delete.text') }}</p>
@endcomponent