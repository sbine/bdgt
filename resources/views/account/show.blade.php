@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="/accounts">{{ trans('labels.accounts.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $account->name }}</div>
@endsection

@section('breadcrumbs.actions')
	<a href="#editAccountModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> {{ trans('labels.accounts.edit_button') }}</a>
@endsection

@section('content')
		<h2>
			{{ $account->name }}
			<span class="pull-right">
				@money($account->running_balance)
			</span>
		</h2>
		<p class="pull-right">
			@number($account->interest)%
		</p>
		<br><br>
		<p class="lead">{{ trans('labels.transactions.plural') }}</p>
		<table class="table">
			{!! $transactions !!}
		</table>
		<a href="#deleteAccountModal" data-toggle="modal" class="pull-right">{{ trans('labels.accounts.delete_button') }}</a>

	@include('account.modals.edit')
	@include('account.modals.delete')
@endsection
