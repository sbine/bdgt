@extends('app')

@section('breadcrumbs.items')
	<li><a href="/bills">Bills</a></li>
	<li class="active">{{ $bill->label }}</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#editBillModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</a>
	<!-- <a href="#deleteBillModal" data-toggle="modal" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Delete</a> -->
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="{{ config('layout.grid_class') }}">
				<h2>
					{{ $bill->label }}
					@if ($bill->total >= $bill->amount)
						<span class="label label-success">PAID</span>
					@else
						<span class="label label-danger">UNPAID</span>
					@endif
					<span class="pull-right">
						$ {{ number_format($bill->amount, 2) }}
					</span>
				</h2>
				<p>
					Due <span class="moment">{{ $bill->nextDue }}</span>
					<span class="text-muted">({{ $bill->nextDue }})</span>
				</p>
				<p>$ {{ number_format($bill->total, 2) }} paid since {{ $bill->lastDue }}</p>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="{{ config('layout.grid_class') }}">
				<p class="lead">Payments</p>
				<table class="table">
					{!! $transactions !!}
				</table>
			</div>
		</div>
		<div class="row">
			<div class="{{ config('layout.grid_class') }}">
				<a href="#deleteBillModal" data-toggle="modal" class="pull-right">Delete this bill</a>
			</div>
		</div>
	</div>

	@include('bill.modals.edit')
	@include('bill.modals.delete')
@endsection
