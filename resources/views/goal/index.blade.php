@extends('app')

@section('breadcrumbs.items')
    <div class="breadcrumb breadcrumb--active">{{ trans('labels.goals.plural') }}</div>
@endsection

@section('breadcrumbs.actions')
    <toggle>
        <template v-slot="{ isOn, setTo }">
            <a class="button button--success" href="#" @click.prevent="setTo(true)">
                <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> {{ trans('labels.goals.add_button') }}
            </a>

            <modal :value="isOn" @input="setTo(false)">
                @include('goal.modals.create')
            </modal>
        </template>
    </toggle>
@endsection

@section('content')
    <div class="bg-white rounded-xs shadow-sm">
        @foreach ($goals as $goal)
            <a href="{{ route('goals.show', $goal->id) }}" class="block hover:bg-gray-100 border-gray-400 p-6">
                <h4 class="flex justify-between text-2xl">
                    {{ $goal->label }}
                    <span>@money($goal->amount)</span>
                </h4>

                <div class="py-2">
                    <progress-bar
                        :achieved="{{ $goal->achieved ? 'true' : 'false' }}"
                        :balance="{{ $goal->balance }}"
                        :progress="{{ $goal->progress }}"
                    ></progress-bar>
                </div>

                <div class="flex justify-between">
                    <p><formatter-currency :amount="{{ $goal->balance }}"></formatter-currency> saved</p>
                    @if ($goal->amount > $goal->balance)
                        <p><formatter-currency :amount="{{ $goal->amount - $goal->balance }}"></formatter-currency> remaining</p>
                    @elseif ($goal->amount == $goal->balance)
                        <p>Goal reached!</p>
                    @elseif($goal->amount < $goal->balance)
                        <p>Goal reached! (<formatter-currency :amount="{{ $goal->balance - $goal->amount}}"></formatter-currency> extra balance)</p>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
@endsection
