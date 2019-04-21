@if (session()->has('alerts'))
	<div>
		@foreach (session('alerts') as $type => $alert)
			<toggle on>
				<template v-slot="{ isOn, setTo }">
					<div class="alert alert--{{ $type }} relative mb-6" v-if="isOn">
						{{ $alert }}

						<div
							class="absolute cursor-pointer right-0 top-0 mr-2 xl:mr-3"
							@click="setTo(false)"
						>
							<div class="text-3xl text-gray-600 hover:text-gray-700">
								<font-awesome-icon icon="times" class="p-1"></font-awesome-icon>
							</div>
						</div>
					</div>
				</template>
			</toggle>
		@endforeach
	</div>
@endif

@if (session()->has('errors'))
	<div>
		@foreach (session('errors')->all() as $alert)
			<toggle on>
				<template v-slot="{ isOn, setTo }">
					<div class="alert alert--danger relative mb-6" v-if="isOn">
						{{ $alert }}

						<div
							class="absolute cursor-pointer right-0 top-0 mr-2 xl:mr-3"
							@click="setTo(false)"
						>
							<div class="text-3xl text-gray-600 hover:text-gray-700">
								<font-awesome-icon icon="times" class="p-1"></font-awesome-icon>
							</div>
						</div>
					</div>
				</template>
			</toggle>
		@endforeach
	</div>
@endif
