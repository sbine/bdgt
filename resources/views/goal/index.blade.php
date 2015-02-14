@extends('app')

@section('breadcrumbs.items')
	<li><a href="/goals">Goals</a></li>
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

	<div id="addGoalModal" class="modal fade">
		<div class="modal-dialog">
			<form class="modal-content form-horizontal" method="POST" action="/goals">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Add a Goal</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="label" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Goal Amount</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" name="amount" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Goal Date</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="goal_date">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Interest Rate</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="text" class="form-control" name="interest">
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</form>
		</div>
	</div>
@endsection