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
	<transactions-table :transactions='@json($transactions)'></transactions-table>

	@include('transaction.modals.edit')
	@include('transaction.modals.delete')
@endsection
