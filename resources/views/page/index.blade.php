@extends('guest')

@section('content')
	<div class="row">
		<div class="col-xs-12 text-center">
			<div class="jumbotron">
				<h1>bdgt
					<span class="badge">alpha</span></h1>
			</div>
			@if (!Auth::user())
			<p><a class="btn btn-success btn-lg" href="/auth/login" role="button">Sign In</a></p>
			@endif
		</div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-4">
			<h3>Planned Features</h3>
			<div class="media">
				<div class="media-left">
					<span class="media-object">
						<i class="fa fa-envelope-o fa-4x"></i>
					</span>
				</div>
				<div class="media-body">
					<h4 class="media-heading">Zero-based Budgeting</h4>
					Budget to zero using the envelope method to keep your spending in check. Consult your categories to help guide purchasing decisions.
				</div>
			</div>
			<div class="media">
				<div class="media-body">
					<h4 class="media-heading">Automatic Bill Reminders</h4>
					Receive email and push notifications when due dates approach for unpaid bills. Never miss a payment again.
				</div>
				<div class="media-right">
					<span class="media-object">
						<i class="fa fa-calendar-o fa-4x"></i>
					</span>
				</div>
			</div>
			<div class="media">
				<div class="media-left">
					<span class="media-object">
						<i class="fa fa-check-square-o fa-4x"></i>
					</span>
				</div>
				<div class="media-body">
					<h4 class="media-heading">Goal Tracking</h4>
					Achieve your goals with bdgt goal tracking. Painlessly save your way to every milestone.
				</div>
			</div>
			<div class="media">
				<div class="media-body">
					<h4 class="media-heading">Interactive Reports</h4>
					 Access your historical data at any time through bdgt's comprehensive reports. Knowledge is power -- analyze past trends to better plan for your future.
				</div>
				<div class="media-right">
					<span class="media-object">
						<i class="fa fa-bar-chart fa-4x"></i>
					</span>
				</div>
			</div>
		</div>
	</div>
@endsection
