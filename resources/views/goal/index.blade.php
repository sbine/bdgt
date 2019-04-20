@extends('app')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">{{ trans('labels.goals.plural') }}</div>
@endsection

@section('breadcrumbs.actions')
	<a class="button button--success block sm:inline-block" href="#addGoalModal" data-toggle="modal">
		<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> {{ trans('labels.goals.add_button') }}
	</a>
@endsection

@section('content')
	<div class="bg-white shadow rounded -mt-4">
		@foreach ($goals as $goal)
			<a href="{{ route('goals.show', $goal->id) }}" class="block hover:bg-gray-100 border-b p-6">
				<h4 class="flex justify-between text-2xl">
					{{ $goal->label }}
					<span>@money($goal->amount)</span>
				</h4>

				<div class="py-2">
					<progress-bar
						:achieved="{{ $goal->achieved ? 'true' : 'false' }}"
						:balance="{{ $goal->balance }}"
						:progress="{{ $goal->progress }}"
					></progress-bar>
				</div>

				<p><formatter-currency :amount="{{ $goal->balance }}"></formatter-currency> saved</p>
			</a>
		@endforeach
	</div>

	@include('goal.modals.create')
@endsection
