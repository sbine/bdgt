<template>
  <div class="bg-gray-200 border border-gray-400 rounded-xs">
    <div
      class="text-center text-sm px-2 py-1"
      :class="{
        'text-white': progress > 0,
        'bg-green-500': progress > 0 && achieved,
        'bg-orange-400': progress > 0 && balance > 0,
        'bg-red-500': progress > 0 && !achieved && !balance,
      }"
      role="progressbar"
      :aria-valuenow="progress"
      aria-valuemin="0"
      aria-valuemax="100"
      :style="{
        width: Math.min(Math.max(parseInt(progress), 0), 100) + '%',
        minWidth: '1%',
      }"
    >
      {{ progress }}%
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
