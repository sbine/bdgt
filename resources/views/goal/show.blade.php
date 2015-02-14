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

	<div id="editGoalModal" class="modal fade">
		<div class="modal-dialog">
			<form class="modal-content form-horizontal" method="POST" action="/goals/{{ $goal->id }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="_method" value="PUT">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Edit Account</h3>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="label" value="{{ $goal->label }}" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Goal Amount</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" name="amount" value="{{ $goal->amount }}" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Current Balance</label>
						<div class="col-sm-8">
							<div class="input-group">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" name="balance" value="{{ $goal->balance }}" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Goal Date</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="goal_date" value="{{ $goal->goal_date }}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Interest Rate</label>
						<div class="col-sm-8">
							<div class="input-group">
								<input type="text" class="form-control" value="{{ $goal->interest }}">
								<span class="input-group-addon">%</span>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit</button>
				</div>
			</form>
		</div>
	</div>

	<div id="deleteGoalModal" class="modal fade">
		<div class="modal-dialog">
			<form class="modal-content form-horizontal" method="POST" action="/goals/{{ $goal->id }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="_method" value="DELETE">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title">Delete Goal</h3>
				</div>
				<div class="modal-body">
					<p class="text-danger">Are you sure you want to delete this goal? This operation cannot be undone.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Delete</button>
				</div>
			</form>
		</div>
	</div>
@endsection
