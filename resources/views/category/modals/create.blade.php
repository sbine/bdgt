@component('partials.modals.form', [
	'id' => 'addCategoryModal',
	'formAction' => '/categories',
	'title' => trans('labels.categories.modals.create.title'),
	'dismissLabel' => trans('labels.categories.modals.create.close_button'),
	'submitLabel' => trans('labels.categories.modals.create.save_button')
])
	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('labels.categories.properties.label') }}</label>
		<div class="col-sm-8">
			<input type="text" class="input-text" name="label" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('labels.categories.properties.budgeted') }}</label>
		<div class="col-sm-8">
			<div class="input-group">
				<span class="input-group-addon">$</span>
				<input type="number" class="input-text" name="budgeted" step="0.01" min="0" max="10000000" required>
			</div>
		</div>
	</div>
@endcomponent
