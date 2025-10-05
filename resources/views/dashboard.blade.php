@extends('app')

@section('breadcrumbs')
    <toggle class="w-full flex justify-end">
        <template v-slot="{ isOn, setTo }">
            <a class="button button--success block sm:inline-block w-full sm:w-auto text-center" href="#" @click.prevent="setTo(true)" dusk="add-transaction">
                <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon> {{ trans('labels.transactions.add_button') }}
            </a>

            <modal :value="isOn" @input="setTo(false)">
                @include('transaction.modals.create')
            </modal>
        </template>
    </toggle>
@endsection

@section('top-content')
    <div class="flex flex-col lg:flex-row justify-between">
        <div class="lg:w-1/3 flex items-center bg-white rounded-xs shadow-sm border-t-4 border-gray-400 px-10 py-6">
            <div class="mr-10">
                <font-awesome-icon icon="dollar-sign" class="fa-2x text-gray-600"></font-awesome-icon>
            </div>
            <div class="flex flex-col">
                <h2 class="font-semibold text-xl text-gray-800">
                    <formatter-currency :amount="{{ $ledger->balance() }}"></formatter-currency>
                </h2>
                <span class="text-gray-600 lowercase">{{ trans('labels.dashboard.properties.current_balance') }}</span>
            </div>
        </div>

        <div class="lg:w-1/3 flex items-center bg-white rounded-xs shadow-sm border-t-4 border-gray-400 px-10 py-6 my-4 lg:my-0 lg:mx-6">
            <div class="mr-10">
                <font-awesome-icon :icon="['far', 'clock']" class="fa-2x text-gray-600"></font-awesome-icon>
            </div>
            <div class="flex flex-col">
                <h2 class="font-semibold text-xl text-gray-800">
                    @if ($ledger->lastPurchase())
                        <formatter-date time="{{ $ledger->lastPurchase() }}" :diff="true" unit="day"></formatter-date>
                    @else
                        <span>N/A</span>
                    @endif
                </h2>
                <span class="text-gray-600 lowercase">{{ trans('labels.dashboard.properties.last_purchase') }}</span>
            </div>
        </div>

        <div class="lg:w-1/3 flex items-center bg-white rounded-xs shadow-sm border-t-4 border-gray-400 px-10 py-6">
            <div class="mr-10">
                <font-awesome-icon :icon="['far', 'calendar']" class="fa-2x text-gray-600"></font-awesome-icon>
            </div>
            <div class="flex flex-col">
                <h2 class="font-semibold text-xl text-gray-800">
                    @if (is_object($nextBill))
                        <formatter-date time="{{ $nextBill->nextDue }}" :diff="true" unit="day"></formatter-date>
                    @else
                        <span>N/A</span>
                    @endif
                </h2>
                <span class="text-gray-600 lowercase">{{ trans('labels.dashboard.properties.next_bill') }}</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="w-full bg-white rounded-xs shadow-sm">
        <transactions-table
            :transactions='{{ json_encode($transactions) }}'
            :show-actions="true"
        ></transactions-table>

        <div class="sm:flex flex-col items-end">
            <a class="link block sm:inline-block text-center mt-4 p-1" download href="{{ route('transactions.export') }}" dusk="export-transaction">
                {{ trans('labels.transactions.export_button') }}
            </a>
        </div>
    </div>

    <transaction-form
        :accounts='{{ json_encode($accounts) }}'
        :bills='{{ json_encode($bills) }}'
        :categories='{{ json_encode($categories) }}'
        :flairs='{{ json_encode($flairs) }}'
    ></transaction-form>
@endsection
