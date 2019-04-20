@extends('app')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">Dashboard</div>
@endsection

@section('breadcrumbs.actions')
	<a class="button button--success block sm:inline-block" href="#addTransactionModal" data-toggle="modal">
		<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> Add Transaction
	</a>
@endsection

@section('top-content')
	<div class="flex flex-col sm:flex-row justify-between">
		<div class="flex items-center bg-white shadow rounded border-t-4 px-10 py-6">
			<div class="mr-10">
				<font-awesome-icon icon="dollar-sign" class="fa-3x text-gray-600"></font-awesome-icon>
			</div>
			<div class="flex flex-col">
				<h2 class="text-3xl text-gray-800">
					<formatter-currency :amount="{{ $ledger->balance() }}"></formatter-currency>
				</h2>
				<span class="text-gray-600">current balance</span>
			</div>
		</div>

		<div class="flex items-center bg-white shadow rounded border-t-4 px-10 py-6 my-4 sm:my-0 sm:mx-6">
			<div class="mr-10">
				<font-awesome-icon :icon="['far', 'clock']" class="fa-3x text-gray-600"></font-awesome-icon>
			</div>
			<div class="flex flex-col">
				<h2 class="text-3xl text-gray-800">
					@if ($ledger->lastPurchase())
						<formatter-date time="{{ $ledger->lastPurchase() }}" :diff="true" unit="day"></formatter-date>
					@else
						<span>N/A</span>
					@endif
				</h2>
				<span class="text-gray-600">last purchase</span>
			</div>
		</div>

		<div class="flex items-center bg-white shadow rounded border-t-4 px-10 py-6">
			<div class="mr-10">
				<font-awesome-icon :icon="['far', 'calendar']" class="fa-3x text-gray-600"></font-awesome-icon>
			</div>
			<div class="flex flex-col">
				<h2 class="text-3xl text-gray-800">
					@if (is_object($nextBill))
						<formatter-date time="{{ $nextBill->nextDue }}" :diff="true" unit="day"></formatter-date>
					@else
						<span>N/A</span>
					@endif
				</h2>
				<span class="text-gray-600">next bill</span>
			</div>
		</div>
	</div>
@endsection

@section('content')
	<transactions-table class="w-full bg-white shadow rounded p-6" :transactions='@json($transactions)'></transactions-table>

	{{--
		<div>@money($ledger->totalInflow())</div>
		<div>@money($ledger->totalOutflow())</div>
	--}}

	@include('transaction.modals.edit')
	@include('transaction.modals.delete')
@endsection
