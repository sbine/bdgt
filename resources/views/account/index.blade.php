@extends('app')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">{{ trans('labels.accounts.plural') }}</div>
@endsection

@section('breadcrumbs.actions')
	<toggle>
		<template v-slot="{ isOn, setTo }">
			<a class="button button--success" href="#" @click.prevent="setTo(true)">
				<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> {{ trans('labels.accounts.add_button') }}
			</a>

			<modal :value="isOn" @input="setTo(false)">
				@include('account.modals.create')
			</modal>
		</template>
	</toggle>
@endsection

@section('content')
	<div class="bg-white rounded-sm shadow">
		@foreach ($accounts as $account)
			<a href="{{ route('accounts.show', $account->id) }}" class="block hover:bg-gray-100 border-b p-6">
				<div class="flex justify-between items-center">
					<div>
						<h4 class="text-gray-700 text-xl">
							{{ $account->name }}
						</h4>
						<p class="font-semibold">
							<formatter-currency :amount="{{ $account->balance }}"></formatter-currency>
						</p>
					</div>
					<div class="badge h-8">{{ $account->transactions->count() }}</div>
				</div>
			</a>
		@endforeach
	</div>
@endsection
