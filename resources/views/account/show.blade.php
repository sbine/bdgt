@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="{{ route('accounts.index') }}">{{ trans('labels.accounts.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $account->name }}</div>
@endsection

@section('breadcrumbs.actions')
	<a href="#editAccountModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> {{ trans('labels.accounts.edit_button') }}</a>
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

		<h3 class="font-light text-2xl mb-4 mt-6">{{ trans('labels.transactions.plural') }}</h3>

		<transactions-table :transactions='@json($account->transactions)'></transactions-table>

		<a href="#deleteAccountModal" data-toggle="modal" class="pull-right">{{ trans('labels.accounts.delete_button') }}</a>

	@include('account.modals.edit')
	@include('account.modals.delete')
@endsection
