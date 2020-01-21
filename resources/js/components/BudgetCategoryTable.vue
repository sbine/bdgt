<template>
    <table>
        <thead>
            <tr>
                <td v-if="showCategories"></td>
                <td :colspan="3">
                    <h2 class="hidden sm:block text-center text-gray-800 text-xl mb-4">{{ label }}</h2>
                </td>
            </tr>
            <tr>
                <th v-if="showCategories" class="categories">Categories</th>
                <th class="budgeted">Budgeted</th>
                <th class="spent">Spent</th>
                <th class="balance">Balance</th>
            </tr>
        </thead>

        <tbody>
            <tr
                v-for="(budget, index) in budgets"
                :key="index"
            >
                <td v-if="showCategories" class="categories">
                    {{ budget.category }}
                </td>
                <td class="budgeted">
                    <div class="input-addon--start">
                        <span class="input-addon">$</span>
                        <input class="input-text w-20 sm:w-32" type="number" step="0.01" min="0" max="99999" :value="budget.budgeted || 0" @change="setBudgeted(budget.category_id, $event.target.value)"/>
                    </div>
                </td>
                <td>
                    <formatter-currency :amount="budget.spent || 0" class="spent"/>
                </td>
                <td class="balance">
                    <formatter-currency
                        :amount="budget.balance || 0"
                        class="rounded-lg px-2 py-1"
                        :class="{
                            'font-semibold bg-red-600 text-gray-200': budget.balance < 0,
                            'font-semibold bg-green-500 text-gray-200': budget.balance > 0,
                            'font-semibold bg-gray-500 text-gray-100': ! ( budget.balance < 0 || budget.balance > 0)
                        }"
                    />
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        budgets: {
            type: Array,
            required: true
        },
        label: {
            type: String,
            default: '',
        },
        showCategories: {
            type: Boolean,
        },
    },

    methods: {
        async setBudgeted(category, amount) {
            const idx = this.budgets.findIndex(budget => budget.category_id === category)

            const response = await axios.post(
                `/api/budget/${this.year}/${this.date.format('MM')}/${category}`,
                Object.assign({}, this.budgets[idx], {
                    budgeted: amount,
                })
            )

            this.budgets = this.budgets.map(budget => {
                return budget.category_id === category
                    ? Object.assign({}, budget, {
                        budgeted: response.data.data.budgeted,
                        spent: response.data.data.spent,
                        balance: response.data.data.balance,
                    })
                    : budget
            })
        }
    }
}
</script>

<style lang="scss" scoped>
.categories {
    @apply pr-2;

    @screen sm {
        @apply pr-6;
    }
}

.budgeted {
    @apply border-l-2;
    @apply border-gray-300;
    @apply pl-4;

    @screen sm {
        @apply pl-6;
    }
}

.spent {
    @apply pl-4;

    @screen sm {
        @apply pr-4;
    }
}

.balance {
    @screen sm {
        @apply pr-4;
    }
}

table {
    th {
        @apply p-1;
        @apply pb-4;
        @apply text-left;
    }

    td {
        @apply p-1;
    }
}
</style>
