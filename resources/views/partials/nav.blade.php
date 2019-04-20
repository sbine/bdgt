<nav class="bg-blue-900">
	<div class="flex justify-between">
		<div class="flex items-center justify-center">
			<div class="mr-16">
				<a class="flex items-center block font-light text-gray-400 hover:text-white text-xl px-6 py-4" href="{{ route('index') }}">
					<img class="h-6 mr-2" alt="bdgt" src="/favicon.png">
					<span>bdgt</span>
				</a>
			</div>

			<template v-cloak>
				@auth
					<div class="{{ (request()->route()->getName() == 'dashboard' ? 'active' : '') }}">
						<a class="block text-gray-400 hover:text-white px-6 py-4" href="{{ route('dashboard') }}">Dashboard</a>
					</div>
					<div class="{{ (strpos(request()->route()->getName(), 'accounts') !== false ? 'active' : '') }}">
						<a class="block text-gray-400 hover:text-white px-6 py-4" href="{{ route('accounts.index') }}">{{ trans('labels.accounts.plural') }}</a>
					</div>
					<div class="{{ (strpos(request()->route()->getName(), 'categories') !== false ? 'active' : '') }}">
						<a class="block text-gray-400 hover:text-white px-6 py-4" href="{{ route('categories.index') }}">{{ trans('labels.categories.plural') }}</a>
					</div>
					<div class="{{ (strpos(request()->route()->getName(), 'goals') !== false ? 'active' : '') }}">
						<a class="block text-gray-400 hover:text-white px-6 py-4" href="{{ route('goals.index') }}">{{ trans('labels.goals.plural') }}</a>
					</div>
					<div class="{{ (strpos(request()->route()->getName(), 'bills') !== false ? 'active' : '') }}">
						<a class="block text-gray-400 hover:text-white px-6 py-4" href="{{ route('bills.index') }}">{{ trans('labels.bills.plural') }}</a>
					</div>

					<toggle close-on-blur>
						<div slot-scope="{ isOn, toggle }">
							<a class="block text-gray-400 hover:text-white px-6 py-4" href="#" @click="toggle">
								Reports
								<font-awesome-icon v-if="isOn" icon="caret-up" class="ml-2"></font-awesome-icon>
								<font-awesome-icon v-else icon="caret-down" class="ml-2"></font-awesome-icon>
							</a>

							<div v-if="isOn" class="absolute bg-white shadow-md rounded mt-1">
								<div {{ (strpos(request()->route()->getName(), 'reports.spending_by_category') !== false ? 'active' : '') }}>
									<a class="block text-gray-800 hover:text-gray-600 px-6 py-4" href="/reports/categorial">{{ trans('labels.reports.spending_by_category') }}</a>
								</div>
								<div {{ (strpos(request()->route()->getName(), 'reports.spending_over_time') !== false ? 'active' : '') }}>
									<a class="block text-gray-800 hover:text-gray-600 px-6 py-4" href="/reports/spending">{{ trans('labels.reports.spending_over_time') }}</a>
								</div>
							</div>
						</div>
					</toggle>
				@endauth

				<toggle close-on-blur>
					<div slot-scope="{ isOn, toggle }">
						<a class="block text-gray-400 hover:text-white px-6 py-4" href="#" @click="toggle">
							Calculators
							<font-awesome-icon v-if="isOn" icon="caret-up" class="ml-2"></font-awesome-icon>
							<font-awesome-icon v-else icon="caret-down" class="ml-2"></font-awesome-icon>
						</a>

						<div v-if="isOn" class="absolute bg-white shadow-md rounded mt-1">
							<div {{ (strpos(request()->route()->getName(), 'calculators.debt') !== false ? 'active' : '') }}>
								<a class="block text-gray-800 hover:text-gray-600 px-6 py-4" href="{{ route('calculators.debt') }}">Debt Calculator</a>
							</div>
						</div>
					</div>
				</toggle>
			</template>
		</div>

		<div class="flex items-center justify-center">
			@guest
				<div>
					<a class="block text-gray-400 hover:text-white px-6 py-4" href="/login">{{ trans('labels.auth.login') }}</a>
				</div>
				<div>
					<a class="block text-gray-400 hover:text-white px-6 py-4" href="/register">{{ trans('labels.auth.register') }}</a>
				</div>
			@else
				<div>
					<form action="{{ route('logout') }}" method="POST">
						<button class="text-gray-400 hover:text-white px-6 py-4" type="submit">{{ trans('labels.auth.logout') }}</button>
						@csrf
					</form>
				</div>
			@endguest
		</div>
	</div>
</nav>
