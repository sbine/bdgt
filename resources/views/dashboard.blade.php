@extends('app')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">Dashboard</div>
@endsection

@section('breadcrumbs.actions')
	<toggle>
		<template v-slot="{ isOn, setTo }">
			<a class="button button--success block sm:inline-block" href="#" @click.prevent="setTo(true)">
				<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> {{ trans('labels.transactions.add_button') }}
			</a>

			<modal :value="isOn" @input="setTo(false)">
				@include('transaction.modals.create')
			</modal>
		</template>
	</toggle>
@endsection

@section('top-content')
	<div class="flex flex-col lg:flex-row justify-between">
		<div class="lg:w-1/3 flex items-center bg-white rounded-sm shadow border-t-4 px-10 py-6">
			<div class="mr-10">
				<font-awesome-icon icon="dollar-sign" class="fa-2x text-gray-600"></font-awesome-icon>
			</div>
			<div class="flex flex-col">
				<h2 class="font-semibold text-xl text-gray-800">
					<formatter-currency :amount="{{ $ledger->balance() }}"></formatter-currency>
				</h2>
				<span class="text-gray-600">current balance</span>
			</div>
		</div>

		<div class="lg:w-1/3 flex items-center bg-white rounded-sm shadow border-t-4 px-10 py-6 my-4 lg:my-0 lg:mx-6">
			<div class="mr-10">
				<font-awesome-icon :icon="['far', 'clock']" class="fa-2x text-gray-600"></font-awesome-icon>
			</div>
			<div class="flex flex-col">
				<h2 class="font-semibold text-xl text-gray-800">
					@if ($ledger->lastPurchase())
						<formatter-date time="{{ $ledger->lastPurchase() }}" :diff="true" unit="day"></formatter-date>
					@else
						<span>N/A</span>
					@endif
				</h2>
				<span class="text-gray-600">last purchase</span>
			</div>
		</div>

		<div class="lg:w-1/3 flex items-center bg-white rounded-sm shadow border-t-4 px-10 py-6">
			<div class="mr-10">
				<font-awesome-icon :icon="['far', 'calendar']" class="fa-2x text-gray-600"></font-awesome-icon>
			</div>
			<div class="flex flex-col">
				<h2 class="font-semibold text-xl text-gray-800">
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
	<transactions-table
		:transactions='{{ json_encode($transactions) }}'
		class="w-full bg-white rounded-sm shadow p-6"
	></transactions-table>

	<transaction-form
		:accounts='{{ json_encode($accounts) }}'
		:bills='{{ json_encode($bills) }}'
		:categories='{{ json_encode($categories) }}'
		:flairs='{{ json_encode($flairs) }}'
	></transaction-form>
@endsection
