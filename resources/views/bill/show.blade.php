@extends('app')

@section('breadcrumbs.items')
	<li><a href="/bills">{{ trans('labels.bills.plural') }}</a></li>
	<li class="active">{{ $bill->label }}</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#editBillModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> {{ trans('labels.bills.edit_button') }}</a>
@endsection

@section('content')
	<h2>
		{{ $bill->label }}
		@if ($bill->total >= $bill->amount)
			<span class="label label-success">PAID</span>
		@else
			<span class="label label-danger">UNPAID</span>
		@endif
		<span class="pull-right">
			@money($bill->amount)
		</span>
	</h2>
	<p>
		Due <span class="moment">{{ $bill->nextDue }}</span>
		<span class="text-muted">({{ $bill->nextDue }})</span>
	</p>
	<p>@money($bill->total) paid since {{ $bill->lastDue }}</p>
	<br><br>
	<p class="lead">Payments</p>
	<table class="table">
		{!! $transactions !!}
	</table>
	<a href="#deleteBillModal" data-toggle="modal" class="pull-right">{{ trans('labels.bills.delete_button') }}</a>

	@include('bill.modals.edit')
	@include('bill.modals.delete')
@endsection
