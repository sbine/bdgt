@extends('app')

@section('breadcrumbs.items')
	<li class="active">Transactions</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#addTransactionModal" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Transaction</a>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<table class="table table-bordered">
					{!! $transactions !!}
					<tfoot>
						<tr>
							<td colspan="5"><b>Total</b></td>
							<td><b>$ {{ number_format($ledger->totalInflow(), 2) }}</b></td>
							<td><b>$ {{ number_format($ledger->totalOutflow(), 2) }}</b></td>
							<td colspan="2"></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

	@include('transaction.modals.edit')
@endsection

