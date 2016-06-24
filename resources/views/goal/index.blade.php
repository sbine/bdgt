@extends('app')

@section('breadcrumbs.items')
	<li class="active">Goals</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#addGoalModal" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Goal</a>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="list-group">
					@foreach ($goals as $goal)
						<a href="/goals/{{ $goal->id }}" class="list-group-item">
							<h4 class="list-group-item-heading">{{ $goal->label }}</h4>
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
							<p class="list-group-item-text pull-right">$ {{ number_format($goal->amount, 2) }}</p>
							<p class="list-group-item-text">$ {{ number_format($goal->balance, 2) }} saved</p>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	@include('goal.modals.create')
@endsection