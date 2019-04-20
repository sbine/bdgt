<?php
    if (! isset($useDefaults)) {
        $useDefaults = false;
    }
?>

@if ($useDefaults)
	<input type="hidden" name="cleared" value="0">
	<input type="hidden" name="flair" value="lightgray">
@endif
<div class="flex items-center">
	<label class="w-1/3 text-right mr-4">{{ trans('labels.transactions.properties.date') }}</label>
	<div class="w-2/3">
		<div class="flex items-center">
			<input type="text" class="input-text datepicker" name="date" required>
			<span class="input-addon"><i class="fa fa-calendar"></i></span>
		</div>
	</div>
</div>
<div class="flex items-center">
	<label class="w-1/3 text-right mr-4">{{ trans('labels.transactions.properties.amount') }}</label>
	<div class="w-2/3">
		<div class="flex items-center">
			<span class="input-addon">$</span>
			<input type="number" class="input-text" name="amount" step="0.01" min="0" max="1000000" required>
		</div>
	</div>
</div>
<div class="flex items-center">
	<label class="w-1/3 text-right mr-4">{{ trans('labels.transactions.properties.payee') }}</label>
	<div class="w-2/3">
		<input type="text" class="input-text" name="payee" required>
	</div>
</div>
<div class="flex items-center">
	<label class="w-1/3 text-right mr-4">{{ trans('labels.transactions.properties.account_id') }}</label>
	<div class="w-2/3">
		<select class="input-text" name="account_id" required>
			@include('partials.dropdowns.accounts')
		</select>
	</div>
</div>
<div class="flex items-center">
	<div class="w-1/3 mr-4"></div>
	<div class="w-2/3">
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
<div class="flex items-center">
	<label class="w-1/3 text-right mr-4">{{ trans('labels.transactions.properties.category_id') }}</label>
	<div class="w-2/3">
		<select class="input-text" name="category_id">
			@include('partials.dropdowns.categories')
		</select>
	</div>
</div>
<div class="flex items-center">
	<label class="w-1/3 text-right mr-4">{{ trans('labels.transactions.properties.bill_id') }}</label>
	<div class="w-2/3">
		<select class="input-text" name="bill_id">
			@include('partials.dropdowns.bills')
		</select>
	</div>
</div>
@if (! $useDefaults)
<div class="flex items-center">
	<div class="w-2/3 col-sm-offset-3">
		<div class="checkbox">
			<label>
				<input type="hidden" name="cleared" value="0">
				<input type="checkbox" name="cleared" value="1">
				{{ trans('labels.transactions.properties.cleared') }}
			</label>
		</div>
	</div>
</div>
<div class="flex items-center">
	<label class="w-1/3 text-right mr-4">{{ trans('labels.transactions.properties.flair') }}</label>
	<div class="w-2/3">
		<select class="input-text" name="flair">
			@include('partials.dropdowns.flairs')
		</select>
	</div>
</div>
@endif
