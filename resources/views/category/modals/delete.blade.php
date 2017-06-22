@component('partials.modals.form', [
	'id' => 'deleteCategoryModal',
	'formAction' => '/categories/' . $category->id,
	'method' => 'DELETE',
	'title' => trans('labels.categories.modals.delete.title'),
	'dismissLabel' => trans('labels.categories.modals.delete.close_button'),
	'submitLabel' => trans('labels.categories.modals.delete.save_button')
])
	<p class="text-danger">{{ trans('labels.categories.modals.delete.text') }}</p>
@endcomponent