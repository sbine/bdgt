@extends('app')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">Dashboard</div>
@endsection

@section('breadcrumbs.actions')
	<a class="button block sm:inline-block" href="#addTransactionModal" data-toggle="modal">
		<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> Add Transaction
	</a>
@endsection

@section('top-content')
	<div class="flex justify-between">
		<div class="flex items-center">
			<div class="mr-6">
				<font-awesome-icon icon="dollar-sign" class="fa-4x"></font-awesome-icon>
			</div>
			<div class="flex flex-col">
				<h2 class="text-3xl">
					<formatter-currency :amount="{{ $ledger->balance() }}"></formatter-currency>
				</h2>
				<span class="text-gray-500">current balance</span>
			</div>
		</div>

		<div class="flex">
			<div class="mr-6">
				<font-awesome-icon :icon="['far', 'clock']" class="fa-4x"></font-awesome-icon>
			</div>
			<div class="flex flex-col">
				<h2 class="text-3xl">
					@if ($ledger->lastPurchase())
						<formatter-date time="{{ $ledger->lastPurchase() }}" :diff="true" unit="day"></formatter-date>
					@else
						<span>N/A</span>
					@endif
				</h2>
				<span class="text-gray-500">last purchase</span>
			</div>
		</div>

		<div class="flex">
			<div class="mr-6">
				<font-awesome-icon :icon="['far', 'calendar']" class="fa-4x"></font-awesome-icon>
			</div>
			<div class="flex flex-col">
				<h2 class="text-3xl">
					@if (is_object($nextBill))
						<formatter-date time="{{ $nextBill->nextDue }}" :diff="true" unit="day"></formatter-date>
					@else
						<span>N/A</span>
					@endif
				</h2>
				<span class="text-gray-500">next bill</span>
			</div>
		</div>
	</div>
@endsection

@section('content')
	<transactions-table class="w-full" :transactions='@json($transactions)'></transactions-table>

	{{--
		<div>@money($ledger->totalInflow())</div>
		<div>@money($ledger->totalOutflow())</div>
	--}}

	@include('transaction.modals.edit')
	@include('transaction.modals.delete')
@endsection
