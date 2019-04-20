@component('partials.modals.form', [
	'formAction' => route('goals.update', $goal->id),
	'method' => 'PUT',
	'title' => trans('labels.goals.modals.edit.title'),
	'dismissLabel' => trans('labels.goals.modals.edit.close_button'),
	'submitLabel' => trans('labels.goals.modals.edit.save_button')
])
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.goals.properties.label') }}</label>
		<div class="w-2/3">
			<input type="text" class="input-text" name="label" value="{{ $goal->label }}" required>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.goals.properties.amount') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<span class="input-addon">$</span>
				<input type="number" class="input-text" name="amount" step="0.01" min="0" max="10000000" value="{{ $goal->amount }}" required>
			</div>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.goals.properties.goal_date') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<input type="text" class="input-text datepicker" name="goal_date" value="{{ $goal->goal_date }}">
				<span class="input-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
	</div>
	<div class="flex items-center">
		<label class="w-1/3 text-right mr-4">{{ trans('labels.goals.properties.balance') }}</label>
		<div class="w-2/3">
			<div class="flex items-center">
				<span class="input-addon">$</span>
				<input type="number" class="input-text" name="balance" step="0.01" min="0" max="10000000" value="{{ $goal->balance }}" required>
			</div>
		</div>
	</div>
@endcomponent
