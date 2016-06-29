<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>bdgt</title>

	<link rel="icon" type="image/png" href="/favicon.png">

	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/app.min.css" rel="stylesheet">

	@yield('css')

	<!-- Fonts -->
	<link href="//fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet" type="text/css">
	<link href="/css/font-awesome.min.css" rel="stylesheet">
	<link href="/css/datatables-bootstrap.min.css" rel="stylesheet">
	<link href="/css/bootstrap-slider.min.css" rel="stylesheet">
	<link href="/css/bootstrap-datepicker3.min.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ route('index') }}">
					<img class="navbar-brand-image" alt="bdgt" src="/favicon.png">
					<span>bdgt</span>
				</a>
			</div>

			<div class="collapse navbar-collapse" id="primary-navbar">
				<ul class="nav navbar-nav">
					@if (Auth::user())
					<li class="{{ (request()->route()->getName() == 'index' ? 'active' : '') }}"><a href="{{ route('index') }}">Dashboard</a></li>
					@endif
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Calculators <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('calculators.debt') }}">Debt Calculator</a></li>
							<li class="divider"></li>
							<li><a href="{{ route('calculators.savings') }}">Savings Calculator</a></li>
						</ul>
					</li>
				</ul>
				<!--
				@if (Auth::user())
				<form class="navbar-form navbar-left" role="search">
					<a href="#addTransactionModal" data-toggle="modal" class="btn btn-success"><i class="fa fa-plus"></i> Add Transaction</a>
				</form>
				@endif
				-->

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="/auth/login">Login</a></li>
						<li><a href="/auth/register">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Account <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/auth/logout">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div id="wrapper">

		@if (Auth::user())
		<!-- Sidebar -->
		<div id="sidebar-wrapper">
			<ul class="sidebar-nav">
				<!--
				<li class="sidebar-icon"><a href="/"><i class="fa fa-home fa-2x"></i></a></li>
				<li class="sidebar-divider"></li>
				-->
				<li class="sidebar-icon hidden-xs"><a href="#addTransactionModal" data-toggle="modal"><button class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add Transaction</button></a></li>
				<li class="sidebar-divider hidden-xs"></li>
				<li><a href="{{ route('accounts.index') }}">Accounts</a></li>
				<li><a href="{{ route('categories.index') }}">Categories</a></li>
				<li><a href="{{ route('transactions.index') }}">Transactions</a></li>
				<li><a href="{{ route('bills.index') }}">Bills</a></li>
				<li><a href="{{ route('goals.index') }}">Goals</a></li>
			</ul>
		</div>
		@endif
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">

			@section('alerts')
				@include('alerts')
			@show

			<a class="btn btn-lg btn-block btn-success visible-xs-block" href="#addTransactionModal" data-toggle="modal"><i class="fa fa-plus"></i> Add Transaction</a>

			@yield('top-content')

			@section('breadcrumbs')
			<div class="container-fluid">
				<div class="row">
					<div class="{{ config('layout.grid_class') }}">
						<ol class="breadcrumb">
							<li><a href="{{ route('index') }}">Home</a></li>
							@yield('breadcrumbs.items')
							<div class="pull-right">
								@yield('breadcrumbs.actions')
							</div>
						</ol>
					</div>
				</div>
			</div>
			@show

			@yield('content')

			@if (Auth::user())
				@include('transaction.modals.create')
			@endif
		</div>
	</div>

	<footer class="footer">
		<div class="text-center">
			&copy; {{ date('Y') }} bdgt
		</div>
	</footer>

	<!-- Scripts -->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/jquery.datatables.min.js"></script>
	<script src="/js/datatables-bootstrap.min.js"></script>
	<script src="/js/bootstrap-datepicker.min.js"></script>
	<script src="/js/bootstrap-slider.min.js"></script>
	<script src="/js/moment.min.js"></script>
	<script src="/js/app.min.js"></script>

	@yield('js')

	@yield('scripts')
</body>
</html>
