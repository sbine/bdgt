<script>
import dayjs from 'dayjs'

export default {
    functional: true,

    props: {
        diff: Boolean,
        time: String,
        unit: String,
    },

    render(h, context) {
        function date(value) {
            return dayjs(value).format('MM/DD/YYYY')
        }

        function diff(value, unit = 'day') {
            const days = dayjs(value).diff(dayjs(), unit)
            const units = Math.abs(days) === 1 ? 'day' : 'days'
            const suffix = days > 0
                ? ' from now'
                : ' ago'

            return Math.abs(days) + ' ' + units + ' ' + suffix
        }

        return h('span', {},
            context.props.diff
                ? diff(context.props.time, context.props.unit)
                : date(context.props.time)
        )
    },
}
</script>
