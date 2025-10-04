@component('partials.modals.form', [
    'formAction' => route('bills.update', $bill->id),
    'method' => 'PUT',
    'title' => trans('labels.bills.modals.edit.title'),
    'dismissLabel' => trans('labels.bills.modals.edit.close_button'),
    'submitLabel' => trans('labels.bills.modals.edit.save_button')
])
    <div class="form-row">
        <label class="form-row__label">{{ trans('labels.bills.properties.label') }}</label>
        <div class="form-row__input">
            <input type="text" class="input-text" name="label" value="{{ $bill->label }}" required>
        </div>
    </div>
    <div class="form-row">
        <label class="form-row__label">{{ trans('labels.bills.properties.amount') }}</label>
        <div class="form-row__input input-addon--start">
            <span class="input-addon">$</span>
            <input type="number" class="input-text" name="amount" step="0.01" min="0" max="10000" value="{{ round($bill->amount, 2) }}" required>
        </div>
    </div>
    <div class="form-row">
        <label class="form-row__label">{{ trans('labels.bills.properties.start_date') }}</label>
        <div class="form-row__input">
            <input-datepicker name="start_date" value="{{ $bill->start_date }}" required></input-datepicker>
        </div>
    </div>
    <div class="form-row">
        <label class="form-row__label">{{ trans('labels.bills.properties.frequency') }}</label>
        <div class="form-row__input">
            <input type="number" class="input-text" name="frequency" min="7" max="365" value="{{ $bill->frequency }}" required>
        </div>
    </div>
@endcomponent
