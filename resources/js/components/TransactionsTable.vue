<template>
  <DataTable
    :value="transactions"
    :paginator="true"
    :rows="25"
    :rowsPerPageOptions="[10, 25, 50, 100]"
    sortMode="multiple"
    removableSort
    filterDisplay="row"
    :globalFilterFields="['date', 'account.name', 'category.label', 'payee', 'outflow', 'inflow']"
    tableStyle="width: 100%"
    v-model:filters="filters"
  >
    <template #header>
      <div class="flex justify-between items-baseline" :class="{ 'justify-end': !title }">
        <h3 v-if="!!title" class="font-light text-2xl mb-6">{{ title }}</h3>
        <span class="relative">
          <font-awesome-icon icon="search" class="absolute left-3 top-4 text-gray-400" />
          <InputText v-model="filters['global'].value" placeholder="Search" class="pl-10" />
        </span>
      </div>
    </template>

    <Column v-if="tableHeaders.includes('flair')" field="flair" header="" :sortable="false" style="width: 3rem">
      <template #body="{ data }">
        <font-awesome-icon :icon="['far', 'flag']" :style="{ color: data.flair }" />
      </template>
    </Column>

    <Column v-if="tableHeaders.includes('date')" field="date" header="Date" sortable dataType="date">
      <template #body="{ data }">
        {{ formatDate(data.date) }}
      </template>
    </Column>

    <Column v-if="tableHeaders.includes('account')" field="account.name" header="Account" sortable>
      <template #body="{ data }">
        {{ data.account ? data.account.name : '' }}
      </template>
    </Column>

    <Column v-if="tableHeaders.includes('category')" field="category.label" header="Category" sortable>
      <template #body="{ data }">
        {{ data.category ? data.category.label : '' }}
      </template>
    </Column>

    <Column v-if="tableHeaders.includes('payee')" field="payee" header="Payee" sortable />

    <Column v-if="tableHeaders.includes('outflow')" field="amount" header="Outflow" sortable dataType="numeric">
      <template #body="{ data }">
        <formatter-currency v-if="!data.inflow" :amount="data.amount" />
      </template>
    </Column>

    <Column v-if="tableHeaders.includes('inflow')" field="amount" header="Inflow" sortable dataType="numeric">
      <template #body="{ data }">
        <formatter-currency v-if="data.inflow" :amount="data.amount" />
      </template>
    </Column>

    <Column v-if="tableHeaders.includes('cleared')" field="cleared" header="Cleared" sortable style="width: 5rem">
      <template #body="{ data }">
        <font-awesome-icon icon="check" :class="data.cleared ? 'text-black' : 'text-gray-300'" />
      </template>
    </Column>

    <Column v-if="showActions" header="" :sortable="false" style="width: 8rem">
      <template #body="{ data }">
        <button
          aria-label="Edit transaction"
          class="button button--warning w-8 text-gray-100 p-1 mr-2"
          @click="handleEdit(data.id)"
          dusk="edit-transaction"
        >
          <font-awesome-icon icon="pencil-alt" class="fa-sm" />
        </button>
        <button
          aria-label="Delete transaction"
          class="button button--danger w-8 p-1"
          @click="handleDelete(data.id)"
          dusk="delete-transaction"
        >
          <font-awesome-icon icon="times" class="fa-sm" />
        </button>
      </template>
    </Column>
  </DataTable>
</template>

<script setup>
import { computed, ref } from 'vue'
import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import InputText from 'primevue/inputtext'
import { FilterMatchMode } from '@primevue/core/api'
import dayjs from 'dayjs'
import { useEventBus } from '../composables/useEventBus'

const props = defineProps({
  title: {
    type: String,
  },
  transactions: {
    type: Array,
    required: true,
  },
  showActions: {
    type: Boolean,
  },
  columns: {
    type: Array,
  },
})

const defaultColumns = ['flair', 'date', 'account', 'category', 'payee', 'outflow', 'inflow', 'cleared']

const tableHeaders = computed(() => {
  let cols = props.columns || defaultColumns
  if (props.showActions) {
    cols = [...cols, 'actions']
  }
  return cols
})

const filters = ref({
  global: { value: null, matchMode: FilterMatchMode.CONTAINS },
})

const formatDate = (date) => {
  return dayjs(date).format('MM/DD/YYYY')
}

const eventBus = useEventBus()

const handleEdit = (id) => {
  eventBus.emit('editTransaction', id)
}

const handleDelete = (id) => {
  eventBus.emit('deleteTransaction', id)
}
</script>
