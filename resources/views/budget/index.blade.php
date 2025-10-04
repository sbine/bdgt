@extends('app')

@section('breadcrumbs.items')
    <div class="breadcrumb breadcrumb--active">Budget</div>
@endsection

@section('content')
    <div class="bg-white rounded-xs shadow-sm p-6">
        <budget></budget>
    </div>
@endsection
