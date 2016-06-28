@extends('app')

@section('breadcrumbs.items')
	<li class="active">Categories</li>
@endsection

@section('breadcrumbs.actions')
	<a href="#addCategoryModal" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Category</a>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="{{ config('layout.grid_class') }}">
				<div class="list-group">
					@foreach ($categories as $category)
						<a href="/categories/{{ $category->id }}" class="list-group-item">
							<h4 class="list-group-item-heading">{{ $category->label }}</h4>
							<div class="list-group-item-text">
								<div class="progress">
									<div class="progress-bar
									@if ($category->spent < $category->budgeted)
										progress-bar-success
									@elseif ($category->spent == $category->budgeted)
										progress-bar-warning
									@else
										progress-bar-danger
									@endif
									progress-bar-striped" role="progressbar" aria-valuenow="{{ $category->progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $category->progress }}%; min-width: 1%;">
										{{ $category->progress }}%
										<span class="sr-only">{{ $category->progress }}%</span>
									</div>
								</div>
							</div>
							<p class="list-group-item-text pull-right">$ {{ number_format($category->budgeted, 2) }}</p>
							<p class="list-group-item-text">$ {{ number_format($category->spent, 2) }} spent / $ {{ number_format($category->budgeted - $category->spent, 2) }} remaining</p>
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</div>

	@include('category.modals.edit')
@endsection