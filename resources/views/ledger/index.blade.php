@extends('app')

@section('breadcrumbs.items')
	<li class="active">Dashboard</li>
@endsection

@section('breadcrumbs.actions')
<!--
	<a href="#addTransactionModal" data-toggle="modal" class="{{ config('layout.create_button_class') }}"><i class="fa fa-plus"></i> Add Transaction</a>
-->
@endsection

@section('top-content')
	<div class="container-fluid">
		<div class="row heads-up">
			<div class="{{ config('layout.grid_class') }}">
				<div class="row">
					<div class="col-md-3 col-sm-4">
						<div class="heads-up-item">
							<div class="media-left">
								<span class="media-object">
									<i class="fa fa-dollar fa-4x"></i>
								</span>
							</div>
							<div class="media-body">
								<h2 class="media-heading"><span class="money-signed">@number($ledger->balance())</span></h2>
								<span class="text-muted">current balance</span>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-0">
						<div class="heads-up-item">
							<div class="media-left">
								<span class="media-object">
									<i class="fa fa-clock-o fa-4x"></i>
								</span>
							</div>
							<div class="media-body">
								<h2 class="media-heading">
									@if ($ledger->lastPurchase())
										<span class="moment">{{ $ledger->lastPurchase() }}</span>
									@else
										<span>N/A</span>
									@endif
								</h2>
								<span class="text-muted">last purchase</span>
							</div>
						</div>
					</div>

					<div class="col-md-3 col-md-offset-2 col-sm-4 col-sm-offset-0">
						<div class="heads-up-item">
							<div class="media-left">
								<span class="media-object">
									<i class="fa fa-calendar fa-4x"></i>
								</span>
							</div>
							<div class="media-body">
								<h2 class="media-heading">
									@if (is_object($nextBill))
										<span class="moment">{{ $nextBill->nextDue }}</span>
									@else
										<span>N/A</span>
									@endif
								</h2>
								<span class="text-muted">next bill</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('content')
	<br>
	<table class="table table-striped">
		{!! $transactions !!}
		<tfoot>
			<tr>
				<td colspan="5"><b>Total</b></td>
				<td><b>@money($ledger->totalInflow())</b></td>
				<td><b>@money($ledger->totalOutflow())</b></td>
				<td colspan="2"></td>
			</tr>
		</tfoot>
		<tbody>
		</tbody>
	</table>

	@include('transaction.modals.edit')
	@include('transaction.modals.delete')
@endsection
