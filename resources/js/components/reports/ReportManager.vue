<template functional>
  <component :is="props.type" :url="props.url" />
</template>

<script>
import SpendingByCategory from './SpendingByCategory.vue'
import SpendingOverTime from './SpendingOverTime.vue'

export default {
  components: {
    SpendingByCategory,
    SpendingOverTime,
  },
}
</script>
