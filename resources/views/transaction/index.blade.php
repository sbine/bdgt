@extends('app')

@section('breadcrumbs.items')
	<li class="active">Transactions</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#addTransactionModal" data-toggle="modal" class="{{ config('layout.create_button_class') }}"><i class="fa fa-plus"></i> Add Transaction</a>
@endsection

@section('content')
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

	@include('transaction.modals.edit')
	@include('transaction.modals.delete')
@endsection

