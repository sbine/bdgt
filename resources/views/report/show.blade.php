@extends('app')

@section('breadcrumbs.items')
    <a class="breadcrumb" href="{{ route('reports.index') }}">{{ trans('labels.reports.plural') }}</a>
    <div class="breadcrumb breadcrumb--active">{{ trans('labels.reports.'.$report->name) }}</div>
@endsection

@section('content')
    <div class="bg-white rounded-xs shadow-sm p-6">
        <report-manager
            type="{{ Str::slug($report->name) }}"
            url="{{ $report->url }}"
        ></report-manager>
    </div>
@endsection
