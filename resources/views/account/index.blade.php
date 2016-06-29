@extends('app')

@section('breadcrumbs.items')
	<li class="active">Accounts</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#addAccountModal" data-toggle="modal" class="{{ config('layout.create_button_class') }}"><i class="fa fa-plus"></i> Add Account</a>
@endsection


@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="{{ config('layout.grid_class') }}">
				<div class="list-group">
					@foreach ($accounts as $account)
						<a href="/accounts/{{ $account->id }}" class="list-group-item">
							<span class="badge">{{ $account->transactions->count() }}</span>
							<i class="fa fa-cc-{{ strtolower($account->name) }} fa-3x pull-left"></i>
							<h4 class="list-group-item-heading"> {{ $account->name }}</h4>
							<p class="list-group-item-text">$ {{ number_format($account->balance, 2) }}</p>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	@include('account.modals.create')
@endsection