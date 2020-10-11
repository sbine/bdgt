<template>
    <v-client-table
        :data="transactions"
        :columns="tableHeaders"
        :options="{
            headings: {
                flair: '',
                actions: '',
            },
            perPage: 25,
            texts: {
                filter: 'Search:',
                filterPlaceholder: '',
                limit: 'Showing:'
            },
            sortable: [
                'date',
                'account',
                'category',
                'payee',
                'amount',
                'cleared',
            ],
            customSorting: {
                amount: function (ascending) {
                    return function (a, b) {
                        var aAmount = a.inflow ? a.amount : -a.amount;
                        var bAmount = b.inflow ? b.amount : -b.amount;
                        if (ascending) {
                            return aAmount >= bAmount ? 1 : -1;
                        }
                        return aAmount <= bAmount ? 1 : -1;
                    }
                }
            }
        }"
    >
        <template #flair="{ row }">
            <font-awesome-icon :icon="['far', 'flag']" :style="{ color: row.flair }"/>
        </template>

        <template #date="{ row }">
            <span>{{ formatDate(row.date) }}</span>
        </template>

        <template #account="{ row }">
            <span>{{ row.account ? row.account.name : '' }}</span>
        </template>

        <template #category="{ row }">
            <span>{{ row.category ? row.category.label : '' }}</span>
        </template>

        <template #amount="{ row }">
            <formatter-currency :amount="row.amount" :negative="! row.inflow"/>
        </template>

        <template #cleared="{ row }">
            <font-awesome-icon icon="check" :class="row.cleared ? 'text-black' : 'text-gray-300'"/>
        </template>

        <template #actions="{ row }" v-if="showActions">
            <button aria-label="Edit transaction" class="button button--warning w-8 text-gray-100 p-1" @click="$root.$emit('editTransaction', row.id)" dusk="edit-transaction">
                <font-awesome-icon icon="pencil-alt" class="fa-sm"/>
            </button>

            <button aria-label="Delete transaction" class="button button--danger w-8 p-1" @click="$root.$emit('deleteTransaction', row.id)" dusk="delete-transaction">
                <font-awesome-icon icon="times" class="fa-sm"/>
            </button>
        </template>
    </v-client-table>
</template>

<script>
import dayjs from 'dayjs'

export default {
    props: {
        transactions: {
            type: Array,
            required: true,
        },
        showActions: {
            type: Boolean,
        },
        columns: {
            type: Array,
        }
    },
    data() {
        return {
            defaultColumns: [
                'flair',
                'date',
                'account',
                'category',
                'payee',
                'amount',
                'cleared'
            ],
        }
    },
    computed: {
        tableHeaders() {
            let cols = this.defaultColumns
            if (this.columns) {
                cols = this.columns
            }
            if (this.showActions) {
                cols.push("actions")
            }
            return cols
        }
    },
    methods: {
        formatDate(date) {
            return dayjs(date).format('MM/DD/YYYY');
        }
    }
}
</script>
