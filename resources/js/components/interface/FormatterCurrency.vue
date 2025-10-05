<script>
import { h } from 'vue'
import { formatMoney } from '../../utils'

function FormatterCurrency(props) {
  const amount = formatMoney(props.amount, props.currency)

  return h('span', (props.negative && amount.indexOf('-') !== 0 ? '-' : '') + amount)
}

FormatterCurrency.props = {
  amount: {},
  currency: {
    type: String,
    default: 'USD',
  },
  negative: {
    type: Boolean,
    default: false,
  },
}
export default FormatterCurrency
</script>
