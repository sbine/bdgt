<?php
    if (! isset($useDefaults)) {
        $useDefaults = false;
    }
?>

@if ($useDefaults)
	<input type="hidden" name="cleared" value="0">
	<input type="hidden" name="flair" value="lightgray">
@endif
<div class="form-row">
	<label class="form-row--label">{{ trans('labels.transactions.properties.date') }}</label>

	<div class="form-row--input">
		<input-datepicker name="date" required></input-datepicker>
	</div>
</div>
<div class="form-row">
	<label class="form-row--label">{{ trans('labels.transactions.properties.amount') }}</label>

	<div class="form-row--input input-addon--start">
		<span class="input-addon">$</span>
		<input type="number" class="input-text pl-10" name="amount" step="0.01" min="0" max="1000000" required>
	</div>
</div>
<div class="form-row">
	<label class="form-row--label">{{ trans('labels.transactions.properties.payee') }}</label>

	<div class="form-row--input">
		<input type="text" class="input-text" name="payee" required>
	</div>
</div>
<div class="form-row">
	<label class="form-row--label">{{ trans('labels.transactions.properties.account_id') }}</label>

	<div class="form-row--input">
		<select class="input-text" name="account_id" required>
			@include('partials.dropdowns.accounts')
		</select>
	</div>
</div>
<div class="form-row">
	<div class="form-row--label"></div>
	<div class="form-row--input">
		<label class="input-radio mr-4">
			<input class="mr-1" type="radio" name="inflow" value="1" required>
			{{ trans('labels.transactions.properties.inflow') }}
		</label>
		<label class="input-radio">
			<input class="mr-1" type="radio" name="inflow" value="0" required checked>
			{{ trans('labels.transactions.properties.outflow') }}
		</label>
	</div>
</div>
<div class="form-row">
	<label class="form-row--label">{{ trans('labels.transactions.properties.category_id') }}</label>

	<div class="form-row--input">
		<select class="input-text" name="category_id">
			@include('partials.dropdowns.categories')
		</select>
	</div>
</div>
<div class="form-row">
	<label class="form-row--label">{{ trans('labels.transactions.properties.bill_id') }}</label>

	<div class="form-row--input">
		<select class="input-text" name="bill_id">
			@include('partials.dropdowns.bills')
		</select>
	</div>
</div>
@if (! $useDefaults)
<div class="form-row">
	<div class="form-row--label"></div>
	<div class="form-row--input">
		<label class="input-checkbox">
			<input type="hidden" name="cleared" value="0">
			<input type="checkbox" name="cleared" value="1">
			{{ trans('labels.transactions.properties.cleared') }}
		</label>
	</div>
</div>
<div class="form-row">
	<label class="form-row--label">{{ trans('labels.transactions.properties.flair') }}</label>

	<div class="form-row--input">
		<select class="input-text" name="flair">
			@include('partials.dropdowns.flairs')
		</select>
	</div>
</div>
@endif
