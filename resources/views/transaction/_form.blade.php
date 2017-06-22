<?php
    if (!isset($useDefaults)) {
        $useDefaults = false;
    }
?>

@if ($useDefaults)
	<input type="hidden" name="cleared" value="0">
	<input type="hidden" name="flair" value="lightgray">
@endif
<div class="form-group">
	<label class="col-sm-3 control-label">{{ trans('labels.transactions.properties.date') }}</label>
	<div class="col-sm-8">
		<div class="input-group">
			<input type="text" class="form-control datepicker" name="date" required>
			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">{{ trans('labels.transactions.properties.amount') }}</label>
	<div class="col-sm-8">
		<div class="input-group">
			<span class="input-group-addon">$</span>
			<input type="number" class="form-control" name="amount" step="0.01" min="0" max="1000000" required>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">{{ trans('labels.transactions.properties.payee') }}</label>
	<div class="col-sm-8">
		<input type="text" class="form-control" name="payee" required>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">{{ trans('labels.transactions.properties.account_id') }}</label>
	<div class="col-sm-8">
		<select class="form-control" name="account_id" required>
			@include('partials.dropdowns.accounts')
		</select>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-8 col-sm-offset-3">
		<div class="radio">
			<label>
				<input type="radio" name="inflow" value="1" required>
				{{ trans('labels.transactions.properties.inflow') }}
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="inflow" value="0" required checked>
				{{ trans('labels.transactions.properties.outflow') }}
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">{{ trans('labels.transactions.properties.category_id') }}</label>
	<div class="col-sm-8">
		<select class="form-control" name="category_id">
			@include('partials.dropdowns.categories')
		</select>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">{{ trans('labels.transactions.properties.bill_id') }}</label>
	<div class="col-sm-8">
		<select class="form-control" name="bill_id">
			@include('partials.dropdowns.bills')
		</select>
	</div>
</div>
@if (!$useDefaults)
<div class="form-group">
	<div class="col-sm-8 col-sm-offset-3">
		<div class="checkbox">
			<label>
				<input type="hidden" name="cleared" value="0">
				<input type="checkbox" name="cleared" value="1">
				{{ trans('labels.transactions.properties.cleared') }}
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">{{ trans('labels.transactions.properties.flair') }}</label>
	<div class="col-sm-8">
		<select class="form-control" name="flair">
			@include('partials.dropdowns.flairs')
		</select>
	</div>
</div>
@endif