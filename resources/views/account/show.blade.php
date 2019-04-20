@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="{{ route('accounts.index') }}">{{ trans('labels.accounts.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $account->name }}</div>
@endsection

@section('breadcrumbs.actions')
	<toggle>
		<template slot-scope="{ isOn, setTo }">
			<a class="button button--warning" href="#" @click.prevent="setTo(true)">
				<font-awesome-icon icon="pencil-alt" class="mr-2"></font-awesome-icon> {{ trans('labels.accounts.edit_button') }}
			</a>

			<modal :value="isOn" @input="setTo(false)">
				@include('account.modals.edit')
			</modal>
		</template>
	</toggle>
@endsection

@section('content')
	<h2 class="flex justify-between text-3xl">
		{{ $account->name }}
		<span>
			<formatter-currency :amount="{{ $account->running_balance }}"></formatter-currency>
		</span>
	</h2>

	<p class="mt-2">
		@number($account->interest)%
	</p>

	<div class="bg-white rounded shadow p-6 mt-6">
		<h3 class="font-light text-2xl mb-6">{{ trans('labels.transactions.plural') }}</h3>

		<transactions-table :transactions='@json($account->transactions)'></transactions-table>
	</div>

	<toggle class="flex justify-end">
		<template slot-scope="{ isOn, setTo }">
			<a class="text-red-600 mt-4" href="#" @click.prevent="setTo(true)">
				{{ trans('labels.accounts.delete_button') }}
			</a>

			<modal :value="isOn" @input="setTo(false)">
				@include('account.modals.delete')
			</modal>
		</template>
	</toggle>
@endsection
