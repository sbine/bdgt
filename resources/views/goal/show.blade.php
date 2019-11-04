@extends('app')

@section('breadcrumbs.items')
	<a class="breadcrumb" href="{{ route('goals.index') }}">{{ trans('labels.goals.plural') }}</a>
	<div class="breadcrumb breadcrumb--active">{{ $goal->label }}</div>
@endsection

@section('breadcrumbs.actions')
	<toggle>
		<template v-slot="{ isOn, setTo }">
			<a class="button button--warning" href="#" @click.prevent="setTo(true)">
				<font-awesome-icon icon="pencil-alt" class="mr-2"></font-awesome-icon> {{ trans('labels.goals.edit_button') }}
			</a>

			<modal :value="isOn" @input="setTo(false)">
				@include('goal.modals.edit')
			</modal>
		</template>
	</toggle>
@endsection

@section('content')
	<div class="bg-white rounded-sm shadow p-6">
		<h2 class="flex justify-between text-3xl">
			{{ $goal->label }}
			<span class="pull-right">
				@money($goal->balance) / @money($goal->amount)
			</span>
		</h2>

		<div class="mt-2 py-2">
			<progress-bar
				:achieved="{{ $goal->achieved ? 'true' : 'false' }}"
				:balance="{{ $goal->balance }}"
				:progress="{{ $goal->progress }}"
			></progress-bar>
		</div>

		<p class="mt-2">
			{{ trans('labels.goals.properties.goal_date') }}: @date($goal->goal_date)
			(<formatter-date time="{{ $goal->goal_date }}" :diff="true"></formatter-date>)
		</p>

		<toggle class="flex justify-end">
			<template v-slot="{ isOn, setTo }">
				<a class="text-red-700 mt-4" href="#" @click.prevent="setTo(true)">
					{{ trans('labels.goals.delete_button') }}
				</a>

				<modal :value="isOn" @input="setTo(false)">
					@include('goal.modals.delete')
				</modal>
			</template>
		</toggle>
	</div>
@endsection
