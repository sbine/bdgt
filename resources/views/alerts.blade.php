@if (session('status'))
    <toggle on>
        <template v-slot="{ isOn, setTo }">
            <div class="alert alert--success relative mb-6" role="alert" v-if="isOn">
                {{ session('status') }}

                <div
                    class="absolute cursor-pointer right-0 top-0 mr-2 xl:mr-3"
                    @click="setTo(false)"
                >
                    <div class="text-3xl text-gray-700 hover:text-gray-800">
                        <font-awesome-icon icon="times" class="p-1"></font-awesome-icon>
                    </div>
                </div>
            </div>
        </template>
    </toggle>
@endif

@if (session()->has('alerts'))
    @foreach (session('alerts') as $type => $alert)
        <toggle on>
            <template v-slot="{ isOn, setTo }">
                <div class="alert alert--{{ $type }} relative mb-6" role="alert" v-if="isOn">
                    {{ $alert }}

                    <div
                        class="absolute cursor-pointer right-0 top-0 mr-2 xl:mr-3"
                        @click="setTo(false)"
                    >
                        <div class="text-3xl text-gray-700 hover:text-gray-800">
                            <font-awesome-icon icon="times" class="p-1"></font-awesome-icon>
                        </div>
                    </div>
                </div>
            </template>
        </toggle>
    @endforeach
@endif

@if (session()->has('errors'))
    @foreach (session('errors')->all() as $alert)
        <toggle on>
            <template v-slot="{ isOn, setTo }">
                <div class="alert alert--danger relative mb-6" role="alert" v-if="isOn">
                    {{ $alert }}

                    <div
                        class="absolute cursor-pointer right-0 top-0 mr-2 xl:mr-3"
                        @click="setTo(false)"
                    >
                        <div class="text-3xl text-gray-700 hover:text-gray-800">
                            <font-awesome-icon icon="times" class="p-1"></font-awesome-icon>
                        </div>
                    </div>
                </div>
            </template>
        </toggle>
    @endforeach
@endif
