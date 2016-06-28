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

	<div id="editBillModal" class="modal fade">
		<div class="modal-dialog">
			<form class="modal-content form-horizontal" method="POST" action="/bills/{{ $bill->id }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="_method" value="PUT">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Edit Bill</h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Payee</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="label" value="{{ $bill->label }}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Amount</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="amount" value="{{ $bill->amount }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Date</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="start_date" value="{{ $bill->start_date }}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Frequency</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="frequency" value="{{ $bill->frequency }}" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>
			</form>
		</div>
	</div>

	<div id="deleteBillModal" class="modal fade">
		<div class="modal-dialog">
			<form class="modal-content form-horizontal" method="POST" action="/bills/{{ $bill->id }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="_method" value="DELETE">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Delete Bill</h3>
				</div>
				<div class="modal-body">
					<p class="text-danger">Are you sure you want to delete this bill? This operation cannot be undone.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Delete</button>
				</div>
			</form>
		</div>
	</div>
@endsection
