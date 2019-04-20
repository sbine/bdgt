@extends('app')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">{{ trans('labels.bills.plural') }}</div>
@endsection

@section('breadcrumbs.actions')
	<a class="button button--success block sm:inline-block" href="#addBillModal" data-toggle="modal">
		<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> {{ trans('labels.bills.add_button') }}
	</a>
@endsection

@section('content')
	<div class="lg:flex">
		<div class="lg:w-2/3 bg-white shadow rounded mb-8 lg:mb-0 lg:mr-10">
			<bill-calendar></bill-calendar>
		</div>

		<div class="lg:w-1/3 bg-white shadow rounded p-6">
			@foreach ($bills as $bill)
				<a href="{{ route('bills.show', $bill->id) }}" class="block py-4">
					<div class="flex justify-between">
						<h4 class="font-semibold text-lg">{{ $bill->label }}</h4>

						@if ($bill->total >= $bill->amount)
							<span class="badge badge--success">paid</span>
						@else
							<span class="badge badge--danger">unpaid</span>
						@endif
					</div>
					<div class="flex justify-between font-light mt-2">
						<p>
							Due <formatter-date time="{{ $bill->nextDue }}" :diff="true" unit="day"></formatter-date>
							<span class="hidden">{{ $bill->nextDue }}</span>
						</p>
						<formatter-currency :amount="{{ $bill->amount }}"></formatter-currency>
					</div>
				</a>
			@endforeach
		</div>
	</div>

	@include('bill.modals.create')
@endsection
