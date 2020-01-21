export default {
  data() {
    return {
      debounceTimer: null,
    }
  },

  methods: {
    debounce(callback, delay = 500) {
      clearTimeout(this.debounceTimer)
      this.debounceTimer = setTimeout(() => callback.apply(this, arguments), delay)
    },
  }
}
