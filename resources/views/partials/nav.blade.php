<nav>
	<toggle class="flex items-center justify-between flex-wrap bg-blue-900 p-2">
		<template v-slot="{ isOn, toggle }">
			<a class="block flex items-center flex-shrink-0 font-light text-gray-400 hover:text-white text-xl mr-16 p-4" href="{{ route('index') }}">
				<img class="h-6 mr-2" alt="bdgt" src="/favicon.png">
				<span class="font-semibold text-xl tracking-tight">bdgt</span>
			</a>

			<div class="block lg:hidden">
				<button class="flex items-center border border-gray-400 hover:border-white rounded text-gray-200 hover:text-white mr-3 px-3 py-2" @click="toggle">
					<svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
				</button>
			</div>

			<div class="w-full lg:block flex-grow lg:flex lg:items-center lg:w-auto" :class="{ hidden: ! isOn }">
				<div class="lg:flex lg:items-center lg:flex-grow">
					<template v-cloak>
						@auth
						<div class="{{ (request()->route()->getName() == 'dashboard' ? 'active' : '') }}">
							<a class="block text-gray-400 hover:text-white p-4" href="{{ route('dashboard') }}">Dashboard</a>
						</div>
						<div class="{{ (strpos(request()->route()->getName(), 'accounts') !== false ? 'active' : '') }}">
							<a class="block text-gray-400 hover:text-white p-4" href="{{ route('accounts.index') }}">{{ trans('labels.accounts.plural') }}</a>
						</div>
						<div class="{{ (strpos(request()->route()->getName(), 'categories') !== false ? 'active' : '') }}">
							<a class="block text-gray-400 hover:text-white p-4" href="{{ route('categories.index') }}">{{ trans('labels.categories.plural') }}</a>
						</div>
						<div class="{{ (strpos(request()->route()->getName(), 'goals') !== false ? 'active' : '') }}">
							<a class="block text-gray-400 hover:text-white p-4" href="{{ route('goals.index') }}">{{ trans('labels.goals.plural') }}</a>
						</div>
						<div class="{{ (strpos(request()->route()->getName(), 'bills') !== false ? 'active' : '') }}">
							<a class="block text-gray-400 hover:text-white p-4" href="{{ route('bills.index') }}">{{ trans('labels.bills.plural') }}</a>
						</div>

						<toggle close-on-blur>
							<template v-slot="{ isOn, toggle }">
								<a class="block text-gray-400 hover:text-white p-4" href="#" @click.prevent="toggle">
									Reports
									<font-awesome-icon :icon="isOn ? 'caret-up' : 'caret-down'" class="ml-2"></font-awesome-icon>
								</a>

								<div v-if="isOn" class="absolute bg-white shadow-md rounded mt-1 z-30">
									<div {{ (strpos(request()->route()->getName(), 'reports.spending_by_category') !== false ? 'active' : '') }}>
										<a class="block text-gray-800 hover:text-gray-600 p-4" href="{{ route('reports.show', 'categorial') }}">{{ trans('labels.reports.spending_by_category') }}</a>
									</div>
									<div {{ (strpos(request()->route()->getName(), 'reports.spending_over_time') !== false ? 'active' : '') }}>
										<a class="block text-gray-800 hover:text-gray-600 p-4" href="{{ route('reports.show', 'spending') }}">{{ trans('labels.reports.spending_over_time') }}</a>
									</div>
								</div>
							</template>
						</toggle>
						@endauth

						<toggle close-on-blur>
							<template v-slot="{ isOn, toggle }">
								<a class="block text-gray-400 hover:text-white p-4" href="#" @click.prevent="toggle">
									Calculators
									<font-awesome-icon :icon="isOn ? 'caret-up' : 'caret-down'" class="ml-2"></font-awesome-icon>
								</a>

								<div v-if="isOn" class="absolute bg-white shadow-md rounded mt-1 z-30">
									<div {{ (strpos(request()->route()->getName(), 'calculators.debt') !== false ? 'active' : '') }}>
										<a class="block text-gray-800 hover:text-gray-600 p-4" href="{{ route('calculators.debt') }}">Debt Calculator</a>
									</div>
								</div>
							</template>
						</toggle>
					</template>
				</div>

				<div class="lg:flex items-center">
					@guest
					<div>
						<a class="block text-gray-400 hover:text-white p-4" href="{{ route('login') }}">{{ trans('labels.auth.login') }}</a>
					</div>
					<div>
						<a class="block text-gray-400 hover:text-white p-4" href="{{ route('register') }}">{{ trans('labels.auth.register') }}</a>
					</div>
					@else
					<div>
						<form action="{{ route('logout') }}" method="POST">
							<button class="text-gray-400 hover:text-white p-4" type="submit">{{ trans('labels.auth.logout') }}</button>
							@csrf
						</form>
					</div>
					@endguest
				</div>
			</div>
		</template>
	</toggle>
</nav>
