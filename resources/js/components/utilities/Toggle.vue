<template>
  <div v-clickaway="blur">
    <slot :is-on="isOn" :set-to="setTo" :toggle="toggle" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import clickaway from '../../composables/clickaway'

const props = defineProps({
  closeOnBlur: {
    type: Boolean,
    default: true,
  },
  on: Boolean,
})

const vClickaway = clickaway

const isOn = ref(!!props.on)

const setTo = (value) => {
  isOn.value = !!value
}
const toggle = () => {
  isOn.value = !isOn.value
}
const blur = () => {
  if (props.closeOnBlur) {
    setTo(false)
  }
}
</script>
