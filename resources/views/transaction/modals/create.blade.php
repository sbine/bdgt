@component('partials.modals.form', [
    'formAction' => route('transactions.store'),
    'title' => trans('labels.transactions.modals.create.title'),
    'dismissLabel' => trans('labels.transactions.modals.create.close_button'),
    'submitLabel' => trans('labels.transactions.modals.create.save_button')
])
    @include('transaction._form', [
        'useDefaults' => true
    ])
@endcomponent
