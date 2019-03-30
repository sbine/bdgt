@extends('app')

@section('js')
	<script src="/js/chart.min.js"></script>
@endsection

@section('breadcrumbs.items')
	<a class="breadcrumb" href="/reports">{{ trans('labels.reports.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $report->name }}</div>
@endsection

@section('sidebar-nav')
	<li class="sidebar-icon hidden-xs"><a href="#addTransactionModal" data-toggle="modal"><button class="btn btn-success btn-md"><i class="fa fa-plus"></i> {{ trans('labels.transactions.add_button') }}</button></a></li>
	<li class="sidebar-divider hidden-xs"></li>
	<li><a href="/reports/categorial">{{ trans('labels.reports.spending_by_category') }}</a></li>
	<li><a href="/reports/spending">{{ trans('labels.reports.spending_over_time') }}</a></li>
@overwrite

@section('content')
	<canvas id="bdgtReport" class="report" data-name="{{ $report->name }}" data-url="{{ $report->url }}" height="150%"></canvas>
@endsection
