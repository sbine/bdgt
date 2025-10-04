@extends('guest')

@section('content')
    <div class="text-center mb-16 mt-10">
        <h1 class="font-light text-5xl tracking-tight">
            bdgt
            <span class="badge">alpha</span>
        </h1>
        @guest
            <a class="button button--success mt-2" href="{{ route('login') }}" role="button">{{ trans('labels.auth.sign_in') }}</a>
        @endguest
    </div>

    <div class="max-w-4xl mx-auto p-2">
        <h3 class="font-semibold text-gray-600 text-xl tracking-wide uppercase mb-4">{{ trans('labels.dashboard.properties.planned_features') }}</h3>

        <div class="flex items-center py-6">
            <div class="mr-8">
                <font-awesome-layers class="fa-5x">
                    <font-awesome-icon icon="circle" class="text-gray-300"></font-awesome-icon>
                    <font-awesome-icon :icon="['far', 'envelope']" transform="shrink-8" class="text-blue-900"></font-awesome-icon>
                </font-awesome-layers>
            </div>
            <div class="flex flex-col w-full">
                <h4 class="font-semibold text-xl">{{ trans('labels.dashboard.properties.zero_based_budgeting.title') }}</h4>
                <p class="text-sm">{{ trans('labels.dashboard.properties.zero_based_budgeting.description') }}</p>
            </div>
        </div>
        <div class="flex items-center py-6">
            <div class="flex flex-col w-full">
                <h4 class="font-semibold text-xl">{{ trans('labels.dashboard.properties.automatic_bill_reminders.title') }}</h4>
                <p class="text-sm">{{ trans('labels.dashboard.properties.automatic_bill_reminders.description') }}</p>
            </div>
            <div class="ml-8">
                <font-awesome-layers class="fa-5x">
                    <font-awesome-icon icon="circle" class="text-gray-300"></font-awesome-icon>
                    <font-awesome-icon :icon="['far', 'calendar']" transform="shrink-8" class="text-blue-900"></font-awesome-icon>
                </font-awesome-layers>
            </div>
        </div>
        <div class="flex items-center py-6">
            <div class="mr-8">
                <font-awesome-layers class="fa-5x">
                    <font-awesome-icon icon="circle" class="text-gray-300"></font-awesome-icon>
                    <font-awesome-icon :icon="['far', 'check-square']" transform="shrink-8" class="text-blue-900"></font-awesome-icon>
                </font-awesome-layers>
            </div>
            <div class="flex flex-col w-full">
                <h4 class="font-semibold text-xl">{{ trans('labels.dashboard.properties.goal_tracking.title') }}</h4>
                <p class="text-sm">{{ trans('labels.dashboard.properties.goal_tracking.description') }}</p>
            </div>
        </div>
        <div class="flex items-center py-6">
            <div class="flex flex-col w-full">
                <h4 class="font-semibold text-xl">{{ trans('labels.dashboard.properties.interactive_reports.title') }}</h4>
                    <p class="text-sm">{{ trans('labels.dashboard.properties.interactive_reports.description') }}</p>
            </div>
            <div class="ml-8">
                <font-awesome-layers class="fa-5x">
                    <font-awesome-icon icon="circle" class="text-gray-300"></font-awesome-icon>
                    <font-awesome-icon icon="chart-bar" transform="shrink-8" class="text-blue-900"></font-awesome-icon>
                </font-awesome-layers>
            </div>
        </div>
    </div>
@endsection
