@extends('app')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">{{ trans('labels.accounts.plural') }}</div>
@endsection

@section('breadcrumbs.actions')
	<a class="button button--success block sm:inline-block" href="#addAccountModal" data-toggle="modal">
		<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> {{ trans('labels.accounts.add_button') }}
	</a>
@endsection


@section('content')
	<div class="list-group">
		@foreach ($accounts as $account)
			<a href="/accounts/{{ $account->id }}" class="list-group-item">
				<span class="badge">{{ $account->transactions->count() }}</span>
				<i class="fa fa-cc-{{ strtolower($account->name) }} fa-3x pull-left"></i>
				<h4 class="list-group-item-heading"> {{ $account->name }}</h4>
				<p class="list-group-item-text">@money($account->balance)</p>
			</a>
		@endforeach
	</div>

	@include('account.modals.create')
@endsection
