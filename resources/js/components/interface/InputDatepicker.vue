<template>
  <v-date-picker
    v-model="date"
    :is-required="required"
    :from-date="date"
    :mode="mode"
    :popover="{ placement: 'bottom', visibility: 'click' }"
    dusk="datepicker"
  >
    <template v-slot="{ inputProps, inputEvents, hidePopover }">
      <div class="input-addon--end">
        <input type="hidden" :name="name" :value="timestamp" />
        <input
          type="text"
          class="input-text pr-10"
          :required="required"
          v-bind="inputProps"
          v-on="inputEvents"
          @blur="hidePopover"
        />
        <span class="input-addon cursor-pointer">
          <font-awesome-icon :icon="['far', 'calendar']" />
        </span>
      </div>
    </template>
  </v-date-picker>
</template>

<script>
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
import dayjs from 'dayjs'

export default {
  components: { 'v-date-picker': DatePicker },

  props: {
    mode: {
      type: String,
      default: 'single',
    },
    name: { String },
    required: { Boolean },
    value: {},
  },

  data() {
    return {
      mutableValue: this.value || null,
    }
  },
  computed: {
    date: {
      get() {
        if (!this.mutableValue) {
          return null
        }

        return new Date(this.mutableValue)
      },
      set(value) {
        this.mutableValue = value
        this.$emit('input', value)
      },
    },
    timestamp() {
      return this.date ? dayjs(this.date).format('YYYY-MM-DD') : null
    },
  },

  watch: {
    value(value) {
      this.mutableValue = value
    },
  },
}
</script>
