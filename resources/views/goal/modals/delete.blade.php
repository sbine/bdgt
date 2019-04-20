@component('partials.modals.form', [
	'formAction' => route('goals.destroy', $goal->id),
	'method' => 'DELETE',
	'title' => trans('labels.goals.modals.delete.title'),
	'dismissLabel' => trans('labels.goals.modals.delete.close_button'),
	'submitLabel' => trans('labels.goals.modals.delete.save_button')
])
	<p class="text-red-700">{{ trans('labels.goals.modals.delete.text') }}</p>
@endcomponent
