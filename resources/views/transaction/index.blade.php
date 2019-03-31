@extends('app')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">Transactions</div>
@endsection

@section('breadcrumbs.actions')
	<a class="button button--success block sm:inline-block" href="#addTransactionModal" data-toggle="modal">
		<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> Add Transaction
	</a>
@endsection

@section('content')
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
	</table>

	@include('transaction.modals.edit')
	@include('transaction.modals.delete')
@endsection
