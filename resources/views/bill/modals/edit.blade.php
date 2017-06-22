@component('partials.modals.form', [
	'id' => 'editBillModal',
	'formAction' => '/bills/' . $bill->id,
	'method' => 'PUT',
	'title' => trans('labels.bills.modals.edit.title'),
	'dismissLabel' => trans('labels.bills.modals.edit.close_button'),
	'submitLabel' => trans('labels.bills.modals.edit.save_button')
])
	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('labels.bills.properties.label') }}</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="label" value="{{ $bill->label }}" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('labels.bills.properties.amount') }}</label>
		<div class="col-sm-8">
			<input type="number" class="form-control" name="amount" step="0.01" min="0" max="10000" value="{{ $bill->amount }}">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('labels.bills.properties.start_date') }}</label>
		<div class="col-sm-8">
			<div class="input-group">
				<input type="text" class="form-control datepicker" name="start_date" value="{{ $bill->start_date }}" required>
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label">{{ trans('labels.bills.properties.frequency') }}</label>
		<div class="col-sm-8">
			<input type="number" class="form-control" name="frequency" min="7" max="365" value="{{ $bill->frequency }}" required>
		</div>
	</div>
@endcomponent