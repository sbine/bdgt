@extends('guest')

@section('content')
	<div class="text-center mb-12">
		<h1 class="font-light text-5xl tracking-tight">
			bdgt
			<span class="badge">alpha</span>
		</h1>
		@guest
			<a class="button mt-2" href="{{ route('login') }}" role="button">Sign In</a>
		@endguest
	</div>

	<div class="p-2">
		<h3 class="text-3xl mb-2">Planned Features</h3>
		<div class="flex items-center py-6">
			<div class="mr-8">
				<font-awesome-layers class="fa-5x">
					<font-awesome-icon icon="circle" class="text-gray-300"></font-awesome-icon>
					<font-awesome-icon :icon="['far', 'envelope']" transform="shrink-8" class="text-blue-900"></font-awesome-icon>
				</font-awesome-layers>
			</div>
			<div class="flex flex-col w-full">
				<h4 class="text-xl">Zero-based Budgeting</h4>
				<p class="text-sm">Budget to zero using the envelope method to keep your spending in check. Consult your categories to help guide purchasing decisions.</p>
			</div>
		</div>
		<div class="flex items-center py-6">
			<div class="flex flex-col w-full">
				<h4 class="text-xl">Automatic Bill Reminders</h4>
				<p class="text-sm">Receive email and push notifications when due dates approach for unpaid bills. Never miss a payment again.</p>
			</div>
			<div class="ml-6">
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
				<h4 class="text-xl">Goal Tracking</h4>
				<p class="text-sm">Achieve your goals with bdgt goal tracking. Painlessly save your way to every milestone.</p>
			</div>
		</div>
		<div class="flex items-center py-6">
			<div class="flex flex-col w-full">
				<h4 class="text-xl">Interactive Reports</h4>
					<p class="text-sm">Access your historical data at any time through bdgt's comprehensive reports. Knowledge is power -- analyze past trends to better plan for your future.</p>
			</div>
			<div class="ml-6">
				<font-awesome-layers class="fa-5x">
					<font-awesome-icon icon="circle" class="text-gray-300"></font-awesome-icon>
					<font-awesome-icon icon="chart-bar" transform="shrink-8" class="text-blue-900"></font-awesome-icon>
				</font-awesome-layers>
			</div>
		</div>
	</div>
@endsection
