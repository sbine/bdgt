<template>
    <v-client-table
        :data="transactions"
        :columns="[
            'flair',
            'date',
            'account',
            'category',
            'payee',
            'amount',
            'cleared',
            'actions',
        ]"
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
            }
        }"
    >
        <template slot="flair" slot-scope="{ row }">
            <font-awesome-icon :icon="['far', 'flag']" :style="{ color: row.flair }"/>
        </template>

        <template slot="date" slot-scope="{ row }">
            <span>{{ formatDate(row.date) }}</span>
        </template>

        <template slot="account" slot-scope="{ row }">
            <span>{{ row.account ? row.account.name : '' }}</span>
        </template>

        <template slot="category" slot-scope="{ row }">
            <span>{{ row.category ? row.category.label : '' }}</span>
        </template>

        <template slot="amount" slot-scope="{ row }">
            <formatter-currency :amount="row.amount" :is-inflow="row.inflow"></formatter-currency>
        </template>

        <template slot="cleared" slot-scope="{ row }">
            <font-awesome-icon icon="check" :class="row.cleared ? 'text-black' : 'text-gray-300'"></font-awesome-icon>
        </template>

        <template slot="actions" slot-scope="{ row }">
            <button class="button button--warning w-8 text-gray-100 p-1">
				<font-awesome-icon icon="pencil-alt" class="fa-sm"></font-awesome-icon>
            </button>

            <button class="button button--danger w-8 p-1">
				<font-awesome-icon icon="times" class="fa-sm"></font-awesome-icon>
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
        }
    },

    methods: {
        formatDate(date) {
            return dayjs(date).format('MM/DD/YYYY');
        }
    },
}
</script>
