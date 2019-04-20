@extends('app')

@section('breadcrumbs.items')
	<div class="breadcrumb breadcrumb--active">{{ trans('labels.categories.plural') }}</div>
@endsection

@section('breadcrumbs.actions')
	<toggle>
		<template slot-scope="{ isOn, setTo }">
			<a class="button button--success" href="#" @click.prevent="setTo(true)">
				<font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> {{ trans('labels.categories.add_button') }}
			</a>

			<modal :value="isOn" @input="setTo(false)">
				@include('category.modals.create')
			</modal>
		</template>
	</toggle>
@endsection

@section('content')
	<div class="list-group">
		@foreach ($categories as $category)
			<a href="{{ route('categories.show', $category->id) }}" class="list-group-item">
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
				<p class="list-group-item-text pull-right">@money($category->budgeted)</p>
				<p class="list-group-item-text">@money($category->spent) spent / @money($category->budgeted - $category->spent) remaining</p>
			</a>
		@endforeach
	</div>
@endsection
