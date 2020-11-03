<script>
import { formatMoney } from '../../utils'

export default {
    functional: true,

    props: {
        amount: {},
        currency: {
            type: String,
            default: 'USD',
        },
        negative: {
            type: Boolean,
            default: false,
        },
    },

    render(h, context) {

        axios.get('/api/me').then(response => {
                this.context.props.currency.default = response.data.currency;
            });

        const amount = formatMoney(context.props.amount, context.props.currency)

        return h('span', context.data, (
            context.props.negative && amount.indexOf('-') !== 0
            ? '-'
            : ''
        ) + amount)
    },
}
</script>
