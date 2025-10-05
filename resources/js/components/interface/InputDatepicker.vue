<template>
  <div dusk="datepicker">
    <v-date-picker
      v-model.string="date"
      :is-required="required"
      :masks="mode === 'date' ? { modelValue: 'YYYY-MM-DD' } : { modelValue: 'YYYY-MM-DD HH:mm:ss' }"
      :mode="mode"
      :popover="{ placement: 'bottom', visibility: 'click' }"
    >
      <template v-slot="{ inputValue, inputEvents, togglePopover }">
        <div class="input-addon--end">
          <input
            type="text"
            class="input-text pr-10"
            :name="name"
            :required="required"
            :value="inputValue"
            v-on="inputEvents"
          />
          <span class="input-addon cursor-pointer" @click="togglePopover">
            <font-awesome-icon :icon="['far', 'calendar']" />
          </span>
        </div>
      </template>
    </v-date-picker>
  </div>
</template>

<script>
import { DatePicker } from 'v-calendar'
import 'v-calendar/style.css'

export default {
  components: { 'v-date-picker': DatePicker },
  props: {
    mode: {
      type: String,
      default: 'date',
    },
    name: String,
    required: Boolean,
    modelValue: {},
  },
  data() {
    return {
      date: this.modelValue || null,
    }
  },
  watch: {
    date(newValue) {
      this.$emit('update:modelValue', newValue)
    },
    modelValue(newValue) {
      this.date = newValue
    },
  },
}
</script>
