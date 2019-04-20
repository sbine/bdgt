@component('partials.modals.form', [
	'formAction' => route('accounts.destroy', $account->id),
	'method' => 'DELETE',
	'title' => trans('labels.accounts.modals.delete.title'),
	'dismissLabel' => trans('labels.accounts.modals.delete.close_button'),
	'submitLabel' => trans('labels.accounts.modals.delete.save_button')
])
	<p class="text-red-700">{{ trans('labels.accounts.modals.delete.text') }}</p>
@endcomponent
