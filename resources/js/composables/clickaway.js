export default {
  beforeMount(el, binding) {
    el.onClickaway = function (event) {
      if (el !== event.target && !el.contains(event.target)) {
        // Call the provided method
        binding.value(event)
      }
    }
    document.addEventListener('click', el.onClickaway)
  },
  unmounted(el) {
    document.removeEventListener('click', el.onClickaway)
  },
}
