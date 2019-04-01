@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="{{ route('goals.index') }}">{{ trans('labels.goals.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $goal->label }}</div>
@endsection

@section('breadcrumbs.actions')
	<a href="#editGoalModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> {{ trans('labels.goals.edit_button') }}</a>
@endsection

@section('content')
	<h2 class="flex justify-between text-3xl">
		{{ $goal->label }}
		<span class="pull-right">
			@money($goal->balance) / @money($goal->amount)
		</span>
	</h2>

	<div class="mt-2 py-2">
		<progress-bar
			:achieved="{{ $goal->achieved ? 'true' : 'false' }}"
			:balance="{{ $goal->balance }}"
			:progress="{{ $goal->progress }}"
		></progress-bar>
	</div>

	<p class="mt-2">
		{{ trans('labels.goals.properties.goal_date') }}: {{ $goal->goal_date }}
		(<formatter-date time="{{ $goal->goal_date }}" :diff="true"></formatter-date>)
	</p>

	<a href="#deleteGoalModal" data-toggle="modal" class="pull-right">{{ trans('labels.goals.delete_button') }}</a>

	@include('goal.modals.edit')
	@include('goal.modals.delete')
@endsection
