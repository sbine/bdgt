<template functional>
    <component :is="props.type" :url="props.url"/>
</template>

<script>
import SpendingByCategory from './SpendingByCategory'
import SpendingOverTime from './SpendingOverTime'

export default {
    components: {
        SpendingByCategory,
        SpendingOverTime,
    }
}
</script>
