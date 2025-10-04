@extends('app')

@section('breadcrumbs.items')
    <a class="breadcrumb" href="{{ route('categories.index') }}">{{ trans('labels.categories.plural') }}</a>
    <div class="breadcrumb breadcrumb--active">{{ $category->label }}</div>
@endsection

@section('breadcrumbs.actions')
    <toggle>
        <template v-slot="{ isOn, setTo }">
            <a class="button button--warning" href="#" @click.prevent="setTo(true)">
                <font-awesome-icon icon="pencil-alt" class="mr-2"></font-awesome-icon> {{ trans('labels.categories.edit_button') }}
            </a>

            <modal :value="isOn" @input="setTo(false)">
                @include('category.modals.edit')
            </modal>
        </template>
    </toggle>
@endsection

@section('content')
    <h2 class="flex justify-between text-3xl">
        {{ $category->label }}
        <span>
            <formatter-currency :amount="{{ $category->budgeted - $category->spent}}"></formatter-currency>
        </span>
    </h2>

    <p class="text-right mt-2">
        <formatter-currency :amount="{{ $category->budgeted}}"></formatter-currency>
        Budgeted
    </p>

    <div class="bg-white rounded-xs shadow-sm p-6 mt-6">
        <h3 class="font-light text-2xl mb-6">{{ trans('labels.transactions.plural') }}</h3>

        <transactions-table :transactions='@json($category->transactions)'></transactions-table>
    </div>

    <toggle class="flex justify-end">
        <template v-slot="{ isOn, setTo }">
            <a class="text-red-700 mt-4" href="#" @click.prevent="setTo(true)">
                {{ trans('labels.categories.delete_button') }}
            </a>

            <modal :value="isOn" @input="setTo(false)">
                @include('category.modals.delete')
            </modal>
        </template>
    </toggle>
@endsection
