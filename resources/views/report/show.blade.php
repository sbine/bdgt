@extends('app')

@section('js')
	<script src="/js/chart.min.js"></script>
@endsection

@section('breadcrumbs.items')
	<li><a href="/reports">Reports</a></li>
	<li class="active">{{ $report->name }}</li>
@endsection

@section('sidebar-nav')
	<li class="sidebar-icon hidden-xs"><a href="#addTransactionModal" data-toggle="modal"><button class="btn btn-success btn-md"><i class="fa fa-plus"></i> Add Transaction</button></a></li>
	<li class="sidebar-divider hidden-xs"></li>
	<li><a href="/reports/spending">Spending Over Time</a></li>
@overwrite

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="{{ config('layout.grid_class') }}">
				<canvas id="bdgtReport" data-name="{{ $report->name }}" data-url="{{ $report->url }}"></canvas>
			</div>
		</div>
	</div>
@endsection