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
	<div class="list-group">
		@foreach ($goals as $goal)
			<a href="/goals/{{ $goal->id }}" class="list-group-item">
				<h4 class="list-group-item-heading">
					{{ $goal->label }}
					<span class="pull-right">@money($goal->amount)</span>
				</h4>
				<div class="list-group-item-text">
					<div class="progress">
						<div class="progress-bar
						@if ($goal->achieved)
							progress-bar-success
						@elseif ($goal->balance > 0)
							progress-bar-warning
						@else
							progress-bar-danger
						@endif
						progress-bar-striped" role="progressbar" aria-valuenow="{{ $goal->progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $goal->progress }}%; min-width: 1%;">
							{{ $goal->progress }}%
							<span class="sr-only">{{ $goal->progress }}% Complete</span>
						</div>
					</div>
				</div>
				<p class="list-group-item-text">@money($goal->balance) saved</p>
			</a>
		@endforeach
	</div>

	@include('goal.modals.create')
@endsection
