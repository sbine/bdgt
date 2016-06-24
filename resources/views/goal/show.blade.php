@extends('app')

@section('breadcrumbs.items')
	<li><a href="/goals">Goals</a></li>
	<li class="active">{{ $goal->label }}</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#editGoalModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</a>
	<!-- <a href="#deleteGoalModal" data-toggle="modal" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Delete</a> -->
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
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
				<p>Goal Date: {{ $goal->goal_date }} (<span class="moment">{{ $goal->goal_date }}</span>)</p>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<a href="#deleteGoalModal" data-toggle="modal" class="pull-right">Delete this goal</a>
			</div>
		</div>
	</div>

	@include('goal.modals.edit')
	@include('goal.modals.delete')
@endsection
