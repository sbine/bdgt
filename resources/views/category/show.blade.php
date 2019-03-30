@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="/categories">{{ trans('labels.categories.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $category->label }}</div>
@endsection

@section('breadcrumbs.actions')
	<a href="#editCategoryModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> {{ trans('labels.categories.edit_button') }}</a>
@endsection

@section('content')
		<h2>
			{{ $category->label }}
			<span class="pull-right">
				@money($category->budgeted - $category->spent)
			</span>
		</h2>
		<p class="pull-right">
			@money($category->budgeted) Budgeted
		</p>
		<br><br>
		<p class="lead">{{ trans('labels.transactions.plural') }}</p>
		<table class="table">
			{!! $transactions !!}
		</table>
		<a href="#deleteCategoryModal" data-toggle="modal" class="pull-right">{{ trans('labels.categories.delete_button') }}</a>

	@include('category.modals.edit')
	@include('category.modals.delete')
@endsection
