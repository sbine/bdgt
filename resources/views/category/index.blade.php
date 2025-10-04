@extends('app')

@section('breadcrumbs.items')
    <div class="breadcrumb breadcrumb--active">{{ trans('labels.categories.plural') }}</div>
@endsection

@section('breadcrumbs.actions')
    <toggle>
        <template v-slot="{ isOn, setTo }">
            <a class="button button--success" href="#" @click.prevent="setTo(true)">
                <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> {{ trans('labels.categories.add_button') }}
            </a>

            <modal :value="isOn" @input="setTo(false)">
                @include('category.modals.create')
            </modal>
        </template>
    </toggle>
@endsection

@section('content')
    <div class="bg-white rounded-xs shadow-sm">
        @foreach ($categories as $category)
            <a href="{{ route('categories.show', $category->id) }}" class="block hover:bg-gray-100 border-b border-gray-400 p-6">
                <h4 class="flex justify-between text-2xl">
                    {{ $category->label }}
                    <span><formatter-currency :amount="{{ $category->budgeted - $category->spent }}"></formatter-currency></span>
                </h4>

                <div class="py-2">
                    <progress-bar
                        :achieved="{{ $category->progress > 0 && $category->spent <= $category->budgeted ? 'true' : 'false' }}"
                        :balance="{{ $category->spent }}"
                        :progress="{{ $category->progress }}"
                    ></progress-bar>
                </div>

                <div class="flex justify-between">
                    <p>
                        <formatter-currency :amount="{{ $category->spent }}"></formatter-currency> spent
                    </p>

                    <p>
                        <formatter-currency :amount="{{ $category->budgeted }}"></formatter-currency>
                        budgeted
                    </p>
                </div>
            </a>
        @endforeach
    </div>
@endsection
