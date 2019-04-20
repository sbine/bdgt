@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="{{ route('categories.index') }}">{{ trans('labels.categories.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $category->label }}</div>
@endsection

@section('breadcrumbs.actions')
	<toggle>
		<template slot-scope="{ isOn, setTo }">
			<a class="button button--warning" href="#" @click.prevent="setTo(true)">
				<font-awesome-icon icon="pencil-alt" class="mr-2"></font-awesome-icon> {{ trans('labels.categories.edit_button') }}
			</a>

			<modal :value="isOn" @input="setTo(false)">
				@include('category.modals.edit')
			</modal>
		</template>
	</toggle>
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

	<toggle class="flex justify-end">
		<template slot-scope="{ isOn, setTo }">
			<a class="text-red-600 mt-4" href="#" @click.prevent="setTo(true)">
				{{ trans('labels.categories.delete_button') }}
			</a>

			<modal :value="isOn" @input="setTo(false)">
				@include('category.modals.delete')
			</modal>
		</template>
	</toggle>
@endsection
