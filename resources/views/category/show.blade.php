@extends('app')

@section('breadcrumbs.items')
	<li><a href="/categories">{{ trans('labels.categories.plural') }}</a></li>
	<li class="active">{{ $category->label }}</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#editCategoryModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> {{ trans('labels.categories.edit_button') }}</a>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="{{ config('layout.grid_class') }}">
				<h2>
					{{ $category->label }}
					<span class="pull-right">
						$ {{ number_format(($category->budgeted - $category->spent), 2) }}
					</span>
				</h2>
				<p class="pull-right">
					$ {{ number_format($category->budgeted, 2) }} Budgeted
				</p>
			</div>
		</div>
		<br><br>
		<div class="row">
			<div class="{{ config('layout.grid_class') }}">
				<p class="lead">{{ trans('labels.transactions.plural') }}</p>
				<table class="table">
					{!! $transactions !!}
				</table>
			</div>
		</div>
		<div class="row">
			<div class="{{ config('layout.grid_class') }}">
				<a href="#deleteCategoryModal" data-toggle="modal" class="pull-right">{{ trans('labels.categories.delete_button') }}</a>
			</div>
		</div>
	</div>

	@include('category.modals.edit')
	@include('category.modals.delete')
@endsection
