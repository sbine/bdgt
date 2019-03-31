@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="{{ route('bills.index') }}">{{ trans('labels.bills.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $bill->label }}</div>
@endsection

@section('breadcrumbs.actions')
	<a href="#editBillModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> {{ trans('labels.bills.edit_button') }}</a>
@endsection

@section('content')
	<h2 class="flex justify-between text-3xl">
		<span>
			{{ $bill->label }}
			@if ($bill->total >= $bill->amount)
				<span class="badge badge--success">paid</span>
			@else
				<span class="badge badge--danger">unpaid</span>
			@endif
		</span>
		<span>
			@money($bill->amount)
		</span>
	</h2>
	<p class="mt-4">
		Due <formatter-date time="{{ $bill->nextDue }}" :diff="true"></formatter-date>
		<span class="text-muted">({{ $bill->nextDue }})</span>
	</p>
	<p class="mt-2">
		<formatter-currency :amount="{{ $bill->total }}"></formatter-currency> paid since {{ $bill->lastDue }}
	</p>

	<h3 class="font-light text-2xl mb-4 mt-6">Payments</h3>

	<transactions-table :transactions='@json($bill->transactions)'></transactions-table>

	<a href="#deleteBillModal" data-toggle="modal" class="pull-right">{{ trans('labels.bills.delete_button') }}</a>

	@include('bill.modals.edit')
	@include('bill.modals.delete')
@endsection
