<template functional>
    <div class="bg-gray-200 border rounded-sm">
        <div
            class="text-center text-sm text-white px-2 py-1"
            :class="{
                'bg-green-500': props.achieved,
                'bg-orange-400': props.balance > 0,
                'bg-red-500': ! props.achieved && ! props.balance
            }"
            role="progressbar"
            :aria-valuenow="props.progress"
            aria-valuemin="0"
            aria-valuemax="100"
            :style="{
                width: props.progress + '%',
                minWidth: '1%'
            }"
        >
            {{ props.progress }}%
            <span class="sr-only">{{ props.progress }}% Complete</span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        achieved: Boolean,
        balance: Number,
        progress: Number,
    }
}
</script>
