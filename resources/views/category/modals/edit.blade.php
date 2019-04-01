@component('partials.modals.form', [
	'id' => 'editCategoryModal',
	'formAction' => '/categories/' . $category->id,
	'method' => 'PUT',
	'title' => trans('labels.categories.modals.edit.title'),
	'dismissLabel' => trans('labels.categories.modals.edit.close_button'),
	'submitLabel' => trans('labels.categories.modals.edit.save_button')
])
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.categories.properties.label') }}</label>
		<div class="w-2/3">
			<input type="text" class="input-text" name="label" value="{{ $category->label }}" required>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.categories.properties.budgeted') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<span class="input-addon">$</span>
				<input type="number" class="input-text" name="budgeted" step="0.01" min="0" max="10000000" value="{{ $category->budgeted }}">
			</div>
		</div>
	</div>
@endcomponent
