<template>
  <div class="overflow-auto">
    <h1 class="flex items-center justify-between select-none text-3xl mb-10">
      <font-awesome-icon
        icon="chevron-left"
        class="fa-sm cursor-pointer text-gray-600 hover:text-gray-800 mr-6"
        @click="goBack"
      />
      <span>
        {{ month }}
        <span class="font-light text-gray-500 ml-2">{{ year }}</span>
      </span>
      <font-awesome-icon
        icon="chevron-right"
        class="fa-sm cursor-pointer text-gray-600 hover:text-gray-800 ml-6"
        @click="goForward"
      />
    </h1>

    <div class="flex justify-between">
      <budget-category-table
        v-if="!screenXS"
        :budgets="previousBudgets"
        :setBudgeted="setBudgeted"
        :showCategories="!screenXS"
        :label="previousDate.format('MMMM')"
      />

      <budget-category-table :budgets="budgets" :setBudgeted="setBudgeted" :showCategories="screenXS" :label="month" />

      <budget-category-table
        v-if="screenLG"
        :budgets="nextBudgets"
        :setBudgeted="setBudgeted"
        :label="nextDate.format('MMMM')"
      />
    </div>
  </div>
</template>

<script setup>
import axios from 'axios'
import dayjs from 'dayjs'
import { useDebounce } from '../composables/useDebounce'
import { computed, ref, onMounted, onUnmounted } from 'vue'

const { debounce } = useDebounce()
const date = ref(dayjs())
const previousBudgets = ref([])
const budgets = ref([])
const nextBudgets = ref([])
const windowWidth = ref(window.innerWidth)

const previousDate = computed(() => {
  return date.value.subtract(1, 'month')
})

const month = computed(() => {
  return date.value.format('MMMM')
})
const year = computed(() => {
  return date.value.format('YYYY')
})
const nextDate = computed(() => {
  return date.value.add(1, 'month')
})
const screenXS = computed(() => {
  return windowWidth.value < 640
})
const screenLG = computed(() => {
  return windowWidth.value >= 1024
})

const fetchBudgets = async (delay = 700) => {
  debounce(async () => {
    budgets.value = (await axios.get(`/api/budget/${year.value}/${date.value.format('MM')}`)).data.data

    if (!screenXS.value) {
      previousBudgets.value = (
        await axios.get(`/api/budget/${previousDate.value.year()}/${previousDate.value.format('MM')}`)
      ).data.data
    }
    if (screenLG.value) {
      nextBudgets.value = (
        await axios.get(`/api/budget/${nextDate.value.year()}/${nextDate.value.format('MM')}`)
      ).data.data
    }
  }, delay)
}

const setBudgeted = async (category, amount, budgetDate) => {
  const budgetMonth = dayjs(budgetDate).month()
  let idx, response
  switch (budgetMonth) {
    case previousDate.value.month():
      updateAndReplaceBudget(previousBudgets)
      idx = previousBudgets.value.findIndex((budget) => budget.category_id === category)
      response = await axios.post(
        `/api/budget/${year.value}/${budgetMonth}/${category}`,
        Object.assign({}, previousBudgets.value[idx], {
          budgeted: amount,
        })
      )

      previousBudgets.value = previousBudgets.value.map((budget) => {
        return budget.category_id === category
          ? Object.assign({}, budget, {
              budgeted: response.data.data.budgeted,
              spent: response.data.data.spent,
              balance: response.data.data.balance,
            })
          : budget
      })
      break
    case date.value.month():
      idx = budgets.value.findIndex((budget) => budget.category_id === category)
      response = await axios.post(
        `/api/budget/${year.value}/${budgetMonth}/${category}`,
        Object.assign({}, budgets.value[idx], {
          budgeted: amount,
        })
      )

      budgets.value = budgets.value.map((budget) => {
        return budget.category_id === category
          ? Object.assign({}, budget, {
              budgeted: response.data.data.budgeted,
              spent: response.data.data.spent,
              balance: response.data.data.balance,
            })
          : budget
      })
      break
    case nextDate.value.month():
      idx = nextBudgets.value.findIndex((budget) => budget.category_id === category)
      response = await axios.post(
        `/api/budget/${year.value}/${budgetMonth}/${category}`,
        Object.assign({}, nextBudgets.value[idx], {
          budgeted: amount,
        })
      )

      nextBudgets.value = nextBudgets.value.map((budget) => {
        return budget.category_id === category
          ? Object.assign({}, budget, {
              budgeted: response.data.data.budgeted,
              spent: response.data.data.spent,
              balance: response.data.data.balance,
            })
          : budget
      })
      break
  }
}
const goForward = () => {
  date.value = date.value.add(1, 'month')
  fetchBudgets()
}
const goBack = () => {
  date.value = date.value.subtract(1, 'month')
  fetchBudgets()
}
const onResize = () => {
  windowWidth.value = window.innerWidth
}

onMounted(() => {
  fetchBudgets(0)
  window.addEventListener('resize', onResize)
})

onUnmounted(() => {
  window.removeEventListener('resize', onResize)
})
</script>
