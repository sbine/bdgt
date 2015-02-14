@extends('app')

@section('breadcrumbs')
	<li><a href="/bills">Bills</a></li>
	<li class="active">{{ $bill->label }}</li>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
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
			<div class="col-md-10 col-md-offset-1">
				<p class="lead">Payments</p>
				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Amount Paid</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($bill->transactions as $transaction)
							@if (!$transaction->inflow)
								<tr>
									<td>
										{{ $transaction->date }}
									</td>
									<td>
										$ {{ number_format($transaction->amount, 2) }}
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<a href="#deleteBillModal" data-toggle="modal" class="pull-right">Delete this bill</a>
			</div>
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
