@component('partials.modals.form', [
	'formAction' => route('categories.destroy', $category->id),
	'method' => 'DELETE',
	'title' => trans('labels.categories.modals.delete.title'),
	'dismissLabel' => trans('labels.categories.modals.delete.close_button'),
	'submitLabel' => trans('labels.categories.modals.delete.save_button')
])
	<p class="text-red-700">{{ trans('labels.categories.modals.delete.text') }}</p>
@endcomponent
