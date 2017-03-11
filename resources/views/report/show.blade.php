@extends('app')

@section('js')
	<script src="/js/chart.min.js"></script>
@endsection

@section('breadcrumbs.items')
	<li><a href="/reports">{{ trans('labels.reports.plural') }}</a></li>
	<li class="active">{{ $report->name }}</li>
@endsection

@section('sidebar-nav')
	<li class="sidebar-icon hidden-xs"><a href="#addTransactionModal" data-toggle="modal"><button class="btn btn-success btn-md"><i class="fa fa-plus"></i> {{ trans('labels.transactions.add_button') }}</button></a></li>
	<li class="sidebar-divider hidden-xs"></li>
	<li><a href="/reports/categorial">Spending By Category</a></li>
	<li><a href="/reports/spending">Spending Over Time</a></li>
@overwrite

@section('content')
	<canvas id="bdgtReport" class="report" data-name="{{ $report->name }}" data-url="{{ $report->url }}" height="150%"></canvas>
@endsection