<template functional>
  <div class="bg-gray-200 border rounded-sm">
    <div
      class="text-center text-sm px-2 py-1"
      :class="{
        'text-white': props.progress > 0,
        'bg-green-500': props.progress > 0 && props.achieved,
        'bg-orange-400': props.progress > 0 && props.balance > 0,
        'bg-red-500': props.progress > 0 && !props.achieved && !props.balance,
      }"
      role="progressbar"
      :aria-valuenow="props.progress"
      aria-valuemin="0"
      aria-valuemax="100"
      :style="{
        width: Math.min(Math.max(parseInt(props.progress), 0), 100) + '%',
        minWidth: '1%',
      }"
    >
      {{ props.progress }}%
    </div>
  </div>
</template>

<script>
export default {
  props: {
    achieved: Boolean,
    balance: Number,
    progress: Number,
  },
}
</script>
