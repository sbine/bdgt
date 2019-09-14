@component('partials.modals.form', [
	'formAction' => route('categories.update', $category->id),
	'method' => 'PUT',
	'title' => trans('labels.categories.modals.edit.title'),
	'dismissLabel' => trans('labels.categories.modals.edit.close_button'),
	'submitLabel' => trans('labels.categories.modals.edit.save_button')
])
	<div class="form-row">
		<label class="form-row__label">{{ trans('labels.categories.properties.label') }}</label>
		<div class="form-row__input">
			<input type="text" class="input-text" name="label" value="{{ $category->label }}" required>
		</div>
	</div>
	<div class="form-row">
		<label class="form-row__label">{{ trans('labels.categories.properties.budgeted') }}</label>
		<div class="form-row__input input-addon--start">
			<span class="input-addon">$</span>
			<input type="number" class="input-text" name="budgeted" step="0.01" min="0" max="10000000" value="{{ $category->budgeted }}">
		</div>
	</div>
@endcomponent
