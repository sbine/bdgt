<template>
    <div class="overflow-auto">
        <h1 class="flex items-center justify-between select-none text-3xl mb-10">
            <font-awesome-icon icon="chevron-left" class="fa-sm cursor-pointer text-gray-600 hover:text-gray-800 mr-6" @click="goBack"/>
            <span>
                {{ month }}
                <span class="font-light text-gray-500 ml-2">{{ year }}</span>
            </span>
            <font-awesome-icon icon="chevron-right" class="fa-sm cursor-pointer text-gray-600 hover:text-gray-800 ml-6" @click="goForward"/>
        </h1>

        <div class="flex justify-between">
            <budget-category-table v-if="! screenXS" :budgets="previousBudgets" :showCategories="! screenXS" :label="previousDate.format('MMMM')"/>

            <budget-category-table :budgets="budgets" :showCategories="screenXS" :label="month"/>

            <budget-category-table v-if="screenLG" :budgets="nextBudgets" :label="nextDate.format('MMMM')"/>
        </div>
    </div>
</template>

<script>
import dayjs from 'dayjs'
import Debounce from '../mixins/debounce'

export default {
    mixins: [Debounce],

    data() {
        return {
            date: dayjs(),
            previousBudgets: [],
            budgets: [],
            nextBudgets: [],
            windowWidth: window.innerWidth,
        }
    },

    computed: {
        previousDate() {
            return this.date.subtract(1, 'month')
        },
        month() {
            return this.date.format('MMMM')
        },
        year() {
            return this.date.format('YYYY')
        },
        nextDate() {
            return this.date.add(1, 'month')
        },
        screenXS() {
            return this.windowWidth < 640
        },
        screenLG() {
            return this.windowWidth >= 1024
        },
    },

    methods: {
        async fetchBudgets(delay = 700) {
            this.debounce(async () => {
                this.budgets = (await axios.get(`/api/budget/${this.year}/${this.date.format('MM')}`)).data.data

                if (! this.screenXS) {
                    this.previousBudgets = (await axios.get(`/api/budget/${this.previousDate.year()}/${this.previousDate.format('MM')}`)).data.data
                }
                if (this.screenLG) {
                    this.nextBudgets = (await axios.get(`/api/budget/${this.nextDate.year()}/${this.nextDate.format('MM')}`)).data.data
                }
            }, delay)
        },
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
        },
        goForward() {
            this.date = this.date.add(1, 'month')
            this.fetchBudgets()
        },
        goBack() {
            this.date = this.date.subtract(1, 'month')
            this.fetchBudgets()
        },
        onResize() {
            this.windowWidth = window.innerWidth
        },
    },

    async created() {
        this.fetchBudgets(0)
    },

    mounted() {
        this.$nextTick(() => {
            window.addEventListener('resize', this.onResize)
        })
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.onResize);
    },
}
</script>
