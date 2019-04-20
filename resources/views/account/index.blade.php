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
	<div class="bg-white shadow rounded -mt-4">
		@foreach ($accounts as $account)
			<a href="{{ route('accounts.show', $account->id) }}" class="block hover:bg-gray-100 border-b p-6">
				<h4 class="flex justify-between text-gray-700 text-xl">
					{{ $account->name }}
					<span class="badge">{{ $account->transactions->count() }}</span>
				</h4>

				<p class="font-semibold"><formatter-currency :amount="{{ $account->balance }}"></formatter-currency></p>
			</a>
		@endforeach
	</div>

	@include('account.modals.create')
@endsection
