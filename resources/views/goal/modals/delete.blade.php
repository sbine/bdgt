@component('partials.modals.form', [
	'id' => 'deleteGoalModal',
	'formAction' => '/goals/' . $goal->id,
	'method' => 'DELETE',
	'title' => trans('labels.goals.modals.delete.title'),
	'dismissLabel' => trans('labels.goals.modals.delete.close_button'),
	'submitLabel' => trans('labels.goals.modals.delete.save_button')
])
	<p class="text-danger">{{ trans('labels.goals.modals.delete.text') }}</p>
@endcomponent