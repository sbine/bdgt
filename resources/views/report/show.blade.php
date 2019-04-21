@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="{{ route('reports.index') }}">{{ trans('labels.reports.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $report->name }}</div>
@endsection

@section('content')
	<report-manager
		type="{{ Str::slug($report->name) }}"
		url="{{ $report->url }}"
	></report-manager>
@endsection
