<nav class="bg-blue-900 py-3">
	<toggle class="w-11/12 xl:w-3/4 mx-auto flex flex-wrap items-center justify-between">
		<template v-slot="{ isOn, toggle }">
			<a class="flex flex-shrink-0 items-center font-light text-gray-400 hover:text-white text-xl mr-16 p-2" href="{{ route('index') }}">
				<img class="h-6 mr-2 -ml-2" alt="bdgt" src="/favicon.png">
				<span class="font-semibold text-xl tracking-tight">bdgt</span>
			</a>

			<div class="block lg:hidden">
				<button class="flex items-center border border-gray-400 hover:border-white rounded text-gray-200 hover:text-white px-3 py-2" @click="toggle">
					<svg class="fill-current h-4 w-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<title>Menu</title>
						<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
					</svg>
				</button>
			</div>

			<div class="w-full flex-grow lg:flex lg:items-center lg:w-auto" :class="{ hidden: ! isOn }">
				<div class="lg:flex lg:items-center lg:flex-grow">
					<template v-cloak>
						@auth
						<div class="{{ (request()->route()->getName() == 'dashboard' ? 'active' : '') }}">
							<a class="nav-item mr-4" href="{{ route('dashboard') }}">{{ trans('labels.dashboard.singular') }}</a>
						</div>
						<div class="{{ (strpos(request()->route()->getName(), 'accounts') !== false ? 'active' : '') }}">
							<a class="nav-item mr-4" href="{{ route('accounts.index') }}">{{ trans('labels.accounts.plural') }}</a>
						</div>
						<div class="{{ (strpos(request()->route()->getName(), 'categories') !== false ? 'active' : '') }}">
							<a class="nav-item mr-4" href="{{ route('categories.index') }}">{{ trans('labels.categories.plural') }}</a>
						</div>
						<div class="{{ (strpos(request()->route()->getName(), 'goals') !== false ? 'active' : '') }}">
							<a class="nav-item mr-4" href="{{ route('goals.index') }}">{{ trans('labels.goals.plural') }}</a>
						</div>
						<div class="{{ (strpos(request()->route()->getName(), 'bills') !== false ? 'active' : '') }}">
							<a class="nav-item mr-4" href="{{ route('bills.index') }}">{{ trans('labels.bills.plural') }}</a>
						</div>

						<toggle close-on-blur class="{{ (strpos(request()->route()->getName(), 'reports') !== false ? 'active' : '') }}">
							<template v-slot="{ isOn, toggle }">
								<a class="nav-item mr-4" href="#" @click.prevent="toggle">
									{{ trans('labels.reports.plural') }}
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

						<toggle close-on-blur class="{{ (strpos(request()->route()->getName(), 'calculators') !== false ? 'active' : '') }}">
							<template v-slot="{ isOn, toggle }">
								<a class="nav-item mr-4" href="#" @click.prevent="toggle">
									{{ trans('labels.calculators.plural') }}
									<font-awesome-icon :icon="isOn ? 'caret-up' : 'caret-down'" class="ml-2"></font-awesome-icon>
								</a>

								<div v-if="isOn" class="absolute bg-white shadow-md rounded mt-1 z-30">
									<div {{ (strpos(request()->route()->getName(), 'calculators.debt') !== false ? 'active' : '') }}>
										<a class="block text-gray-800 hover:text-gray-600 p-4" href="{{ route('calculators.debt') }}">{{ trans('labels.calculators.debt.label') }}</a>
									</div>
								</div>
							</template>
						</toggle>
					</template>
				</div>

				<div class="lg:flex items-center -mr-2">
					<toggle close-on-blur>
						<template v-slot="{ isOn, toggle }">
							<a class="nav-item mr-4" href="#" @click.prevent="toggle">
								<span>{{ LaravelLocalization::getSupportedLocales()[LaravelLocalization::getCurrentLocale()]['native'] }}</span>
								<font-awesome-icon :icon="isOn ? 'caret-up' : 'caret-down'" class="ml-2"></font-awesome-icon>
							</a>

							<div v-if="isOn" class="absolute bg-white shadow-md rounded mt-1 z-30">
								@foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $locale)
								<div class="{{ $localeCode == LaravelLocalization::getCurrentLocale() ? 'active' : '' }}">
									<a class="block text-gray-800 hover:text-gray-600 p-4" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
										{{ $locale['native'] }}
									</a>
								</div>
								@endforeach
							</div>
						</template>
					</toggle>

					@guest
					<div>
						<a class="nav-item mr-4" href="{{ route('login') }}">{{ trans('labels.auth.login') }}</a>
					</div>
					<div>
						<a class="nav-item" href="{{ route('register') }}">{{ trans('labels.auth.register') }}</a>
					</div>
					@else
					<div>
						<form action="{{ route('logout') }}" method="POST">
							<button class="nav-item" type="submit">{{ trans('labels.auth.logout') }}</button>
							@csrf
						</form>
					</div>
					@endguest
				</div>
			</div>
		</template>
	</toggle>
</nav>
