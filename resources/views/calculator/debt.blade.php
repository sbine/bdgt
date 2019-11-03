@extends('app')

@section('meta-description')
"Calculate loan duration and total interest paid based on monthly payments."
@overwrite

@section('breadcrumbs.items')
	<div class="breadcrumb">{{ trans('labels.calculators.plural') }}</div>
	<div class="breadcrumb breadcrumb--active">{{ trans('labels.calculators.debt.label') }}</div>
@endsection

@section('content')
	<div class="bg-white rounded-sm shadow p-6">
		<debt-calculator
			payment-label="{{ trans('labels.calculators.debt.properties.payment') }}"
			current-balance-label="{{ trans('labels.calculators.debt.properties.currentBalance') }}"
			interest-rate-label="{{ trans('labels.calculators.debt.properties.interestRate') }}"
			minimum-payment-label="{{ trans('labels.calculators.debt.properties.minimumPayment') }}"
		></debt-calculator>
	</div>
@endsection
