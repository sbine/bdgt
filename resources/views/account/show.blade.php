@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="{{ route('accounts.index') }}">{{ trans('labels.accounts.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $account->name }}</div>
@endsection

@section('breadcrumbs.actions')
	<a href="#editAccountModal" data-toggle="modal" class="button button--warning"><i class="fa fa-pencil"></i> {{ trans('labels.accounts.edit_button') }}</a>
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

		<div class="bg-white shadow rounded p-6 mt-6">
			<h3 class="font-light text-2xl mb-6">{{ trans('labels.transactions.plural') }}</h3>

			<transactions-table :transactions='@json($account->transactions)'></transactions-table>
		</div>

		<div class="flex justify-end">
			<a href="#deleteAccountModal" data-toggle="modal" class="text-red-600 mt-4">{{ trans('labels.accounts.delete_button') }}</a>
		</div>

	@include('account.modals.edit')
	@include('account.modals.delete')
@endsection
