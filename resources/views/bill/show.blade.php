@extends('app')

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
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<table class="table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Amount Paid</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($bill->transactions as $transaction)
							@if (!$bill->inflow)
								<tr>
									<td>
										{{ $transaction->date }}
									</td>
									<td>
										{{ $transaction->amount }}
									</td>
								</tr>
							@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div id="deleteBillModal" class="modal fade">
		<div class="modal-dialog">
			<form class="modal-content form-horizontal" method="POST" action="/bills">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Delete Bill</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Payee</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="label" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Amount</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="amount">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Date</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="start_date" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Frequency</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="frequency" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
@endsection