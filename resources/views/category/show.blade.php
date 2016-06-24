@extends('app')

@section('breadcrumbs.items')
	<li><a href="/categories">Categories</a></li>
	<li class="active">{{ $category->label }}</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#editCategoryModal" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i> Edit</a>
	<!-- <a href="#deleteCategoryModal" data-toggle="modal" class="btn btn-danger btn-xs"><i class="fa fa-close"></i> Delete</a> -->
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
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
			<div class="col-md-10 col-md-offset-1">
				<p class="lead">Transactions</p>
				<table class="table">
					{!! $transactions !!}
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<a href="#deleteCategoryModal" data-toggle="modal" class="pull-right">Delete this category</a>
			</div>
		</div>
	</div>

	@include('category.modals.edit')
	@include('category.modals.delete')
@endsection
