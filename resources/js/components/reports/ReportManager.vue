<template functional>
    <component :is="props.type"/>
</template>

<script>
import SpendingOverTime from './SpendingOverTime'

export default {
    components: {
        SpendingOverTime,
    }
}
</script>
