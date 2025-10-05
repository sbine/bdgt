<template>
  <component :is="type" :url="url" />
</template>

<script>
import SpendingByCategory from './SpendingByCategory.vue'
import SpendingOverTime from './SpendingOverTime.vue'

export default {
  props: ['type', 'url'],
  components: {
    SpendingByCategory,
    SpendingOverTime,
  },
}
</script>
