@component('partials.modals.form', [
    'formAction' => route('bills.destroy', $bill->id),
    'method' => 'DELETE',
    'title' => trans('labels.bills.modals.delete.title'),
    'dismissLabel' => trans('labels.bills.modals.delete.close_button'),
    'submitLabel' => trans('labels.bills.modals.delete.save_button')
])
    <p class="text-red-700">{{ trans('labels.bills.modals.delete.text') }}</p>
@endcomponent
