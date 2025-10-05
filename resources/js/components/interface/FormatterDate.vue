<script>
import { h } from 'vue'
import dayjs from 'dayjs'

function FormatterDate(props) {
  function date(value) {
    return dayjs(value).format('MM/DD/YYYY')
  }

  function diff(value, unit = 'day') {
    const days = dayjs(value).diff(dayjs(), unit)
    const units = Math.abs(days) === 1 ? 'day' : 'days'

    if (days === 0) {
      return 'today'
    }

    if (isNaN(days)) {
      return 'N/A'
    }

    return days > 0 ? 'in ' + Math.abs(days) + ' ' + units : Math.abs(days) + ' ' + units + ' ago'
  }

  return h('span', props.diff ? diff(props.time, props.unit) : date(props.time))
}

FormatterDate.props = {
  diff: Boolean,
  time: String,
  unit: String,
}

export default FormatterDate
</script>
