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
	<label class="col-sm-3 control-label">Date</label>
	<div class="col-sm-8">
		<div class="input-group">
			<input type="text" class="form-control datepicker" name="date" required>
			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">Amount</label>
	<div class="col-sm-8">
		<div class="input-group">
			<span class="input-group-addon">$</span>
			<input type="text" class="form-control" name="amount" required>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">Payee</label>
	<div class="col-sm-8">
		<input type="text" class="form-control" name="payee" required>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">Account</label>
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
				Inflow
			</label>
		</div>
		<div class="radio">
			<label>
				<input type="radio" name="inflow" value="0" required checked>
				Outflow
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">Category</label>
	<div class="col-sm-8">
		<select class="form-control" name="category_id">
			@include('partials.dropdowns.categories')
		</select>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">Bill</label>
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
				<input type="checkbox" name="cleared" value="1">
				Cleared
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="col-sm-3 control-label">Flair</label>
	<div class="col-sm-8">
		<select class="form-control" name="flair">
			@include('partials.dropdowns.flairs')
		</select>
	</div>
</div>
@endif