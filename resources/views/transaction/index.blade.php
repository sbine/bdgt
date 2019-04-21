@extends('app')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">Transactions</div>
@endsection

@section('breadcrumbs.actions')
	<toggle>
		<template v-slot="{ isOn, setTo }">
			<a class="button button--success" href="#" @click.prevent="setTo(true)">
				<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> {{ trans('labels.transactions.add_button') }}
			</a>

			<modal :value="isOn" @input="setTo(false)">
				@include('transaction.modals.create')
			</modal>
		</template>
	</toggle>
@endsection

@section('content')
	<transactions-table :transactions='@json($transactions)'></transactions-table>

	@include('transaction.modals.edit')
	@include('transaction.modals.delete')
@endsection
