import { ref } from 'vue'

const events = ref({})

export function useEventBus() {
  const on = (event, callback) => {
    if (!events.value[event]) {
      events.value[event] = []
    }
    events.value[event].push(callback)
  }

  const emit = (event, ...args) => {
    if (events.value[event]) {
      events.value[event].forEach((callback) => callback(...args))
    }
  }

  const off = (event, callback) => {
    if (events.value[event]) {
      events.value[event] = events.value[event].filter((cb) => cb !== callback)
    }
  }

  return { on, emit, off }
}
