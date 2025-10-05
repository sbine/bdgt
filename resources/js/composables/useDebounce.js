import { ref, onUnmounted } from 'vue'

export function useDebounce() {
  const debounceTimer = ref(null)

  function debounce(callback, delay = 500) {
    clearTimeout(debounceTimer.value)
    debounceTimer.value = setTimeout(() => callback.apply(this, arguments), delay)
  }

  onUnmounted(() => clearTimeout(debounceTimer.value))

  return { debounce }
}
