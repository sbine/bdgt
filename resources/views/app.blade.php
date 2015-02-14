<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bdgt</title>

	<link rel="icon" type="image/png" href="/favicon.png">

	<link href="/css/app.css" rel="stylesheet">

	@yield('css')

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css">
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Bdgt</a>
			</div>

			<div class="collapse navbar-collapse" id="primary-navbar">
				<ul class="nav navbar-nav">
					<li><a href="/">Dashboard</a></li>
					<li><a href="/accounts">Accounts</a></li>
					<li><a href="/transactions">Transactions</a></li>
					<li><a href="/bills">Bills</a></li>
					<li><a href="/goals">Goals</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Calculators <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/calculators/debt">Debt Calculator</a></li>
							<li class="divider"></li>
							<li><a href="/calculators/savings">Savings Calculator</a></li>
						</ul>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="/auth/login">Login</a></li>
						<li><a href="/auth/register">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/auth/logout">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@section('breadcrumbs')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<ol class="breadcrumb">
					<li><a href="/">Home</a></li>
					@yield('breadcrumbs.items')
					<div class="pull-right">
						@yield('breadcrumbs.actions')
					</div>
				</ol>
			</div>
		</div>
	</div>
	@show

	@include('alerts')

	@yield('content')

	<footer class="footer">
		<div class="text-center">
			&copy; {{ date('Y') }} bdgt
		</div>
	</footer>

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
	<script src="//cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
	<script src="/js/app.js"></script>

	@yield('js')

	<script>
	$(document).on('ready ajaxComplete', function() {
		$(".moment").not('.processed-ready').each(function(value) {
			var date = moment($(this).text());

			$(this).text(date.fromNow());

			$(this).addClass('processed-ready');
		});

		$(".money").not('processed-ready').each(function(value) {
			if ($(this).text().charAt(0) == '-') {
				$(this).addClass('negative');
			}
			else {
				$(this).addClass('positive');
			}
		});
	});

	$(document).ready(function() {
		@yield('scripts-ready')
	});
	</script>

	@yield('scripts')
</body>
</html>
