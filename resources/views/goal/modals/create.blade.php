@component('partials.modals.form', [
	'id' => 'addGoalModal',
	'formAction' => '/goals',
	'title' => trans('labels.goals.modals.create.title'),
	'dismissLabel' => trans('labels.goals.modals.create.close_button'),
	'submitLabel' => trans('labels.goals.modals.create.save_button')
])
	<input type="hidden" name="start_date" value="{{ date('Y-m-d') }}">
	<input type="hidden" name="balance" value="0">
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.goals.properties.label') }}</label>
		<div class="w-2/3">
			<input type="text" class="input-text" name="label" required>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.goals.properties.amount') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<span class="input-addon">$</span>
				<input type="number" class="input-text" name="amount" step="0.01" min="0" max="10000000" required>
			</div>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.goals.properties.goal_date') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<input type="text" class="input-text datepicker" name="goal_date">
				<span class="input-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.goals.properties.balance') }}</label>
		<div class="w-2/3">
			<input type="number" class="input-text" name="balance" step="0.01" min="0" max="10000000">
		</div>
	</div>
@endcomponent
