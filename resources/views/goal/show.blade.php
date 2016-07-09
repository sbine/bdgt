@extends('app')

@section('breadcrumbs.items')
	<li><a href="/goals">{{ trans('labels.goals.plural') }}</a></li>
	<li class="active">{{ $goal->label }}</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#editGoalModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> {{ trans('labels.goals.edit_button') }}</a>
@endsection

@section('content')
		<h2>
			{{ $goal->label }}
			<span class="pull-right">
				$ {{ number_format($goal->balance, 2) }} / $ {{ number_format($goal->amount, 2) }}
			</span>
		</h2>
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
		<p>{{ trans('labels.goals.properties.goal_date') }}: {{ $goal->goal_date }} (<span class="moment">{{ $goal->goal_date }}</span>)</p>
		<br><br>
		<a href="#deleteGoalModal" data-toggle="modal" class="pull-right">{{ trans('labels.goals.delete_button') }}</a>

	@include('goal.modals.edit')
	@include('goal.modals.delete')
@endsection
