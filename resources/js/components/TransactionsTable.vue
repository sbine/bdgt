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
            },
            sortable: [
                'date',
                'account',
                'category',
                'payee',
                'amount',
                'cleared',
            ]
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
            <formatter-currency :amount="row.amount" :is-inflow="row.inflow"/>
        </template>

        <template #cleared="{ row }">
            <font-awesome-icon icon="check" :class="row.cleared ? 'text-black' : 'text-gray-300'"/>
        </template>

        <template #actions="{ row }">
            <button class="button button--warning w-8 text-gray-100 p-1" @click="$emit('edit', row.id)">
                <font-awesome-icon icon="pencil-alt" class="fa-sm"/>
            </button>

            <button class="button button--danger w-8 p-1" @click="$emit('delete', row.id)">
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
        }
    },

    methods: {
        formatDate(date) {
            return dayjs(date).format('MM/DD/YYYY');
        }
    },
}
</script>
