@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="{{ route('bills.index') }}">{{ trans('labels.bills.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $bill->label }}</div>
@endsection

@section('breadcrumbs.actions')
	<toggle>
		<template v-slot="{ isOn, setTo }">
			<a class="button button--warning" href="#" @click.prevent="setTo(true)">
				<font-awesome-icon icon="pencil-alt" class="mr-2"></font-awesome-icon> {{ trans('labels.bills.edit_button') }}
			</a>

			<modal :value="isOn" @input="setTo(false)">
				@include('bill.modals.edit')
			</modal>
		</template>
	</toggle>
@endsection

@section('content')
	<h2 class="flex justify-between text-3xl">
		<span>
			{{ $bill->label }}
			@if ($bill->total >= $bill->amount)
				<span class="badge badge--success">paid</span>
			@else
				<span class="badge badge--danger">unpaid</span>
			@endif
		</span>
		<span>
			@money($bill->amount)
		</span>
	</h2>
	<p class="mt-4">
		Due <formatter-date time="{{ $bill->nextDue }}" :diff="true"></formatter-date>
		<span class="text-gray-700">({{ $bill->nextDue }})</span>
	</p>
	<p class="mt-2">
		<formatter-currency :amount="{{ $bill->total }}"></formatter-currency> paid since @date($bill->lastDue)
	</p>

	<div class="bg-white rounded-sm shadow p-6 mt-6">
		<h3 class="font-light text-2xl mb-6">Payments</h3>

		<transactions-table :transactions='@json($bill->transactions)'></transactions-table>

		<toggle class="flex justify-end">
			<template v-slot="{ isOn, setTo }">
				<a class="text-red-700 mt-4" href="#" @click.prevent="setTo(true)">
					{{ trans('labels.bills.delete_button') }}
				</a>

				<modal :value="isOn" @input="setTo(false)">
					@include('bill.modals.delete')
				</modal>
			</template>
		</toggle>
	</div>
@endsection
