<template>
     <div>
        <p class="text-2xl">
            Paid off
            <span v-if="interestPaid > -1">
                <span class="text-green-700">
                    {{ payoffDateRelative }}
                </span>
                on {{ payoffDateFormatted }}
            </span>
            <span v-else class="text-red-700">
                in 80+ years
            </span>
        </p>
        <p class="text-xl mt-6">
            Total interest:
            <formatter-currency
                v-if="interestPaid > -1"
                class="text-red-700"
                :amount="interestPaid"
                :is-inflow="true"
            />
            <span v-else>N/A</span>
        </p>

        <div v-if="interestPaid === -1">
            <span class="text-red-700">Increase your monthly payments -- current payment plan will take over 80 years!</span>
        </div>

        <div class="mt-6">
            <p>
                {{ paymentLabel }}:
                <formatter-currency class="text-green-700" :amount="payment"/>
            </p>
            <vue-slider v-model="payment" :min="10" :max="1000" :lazy="true" />
        </div>

		<div class="sm:w-2/3 mt-10">
			<div class="form-row">
				<label class="form-row--label">
                    {{ currentBalanceLabel }}
                </label>
				<div class="form-row--input input-addon--start">
					<span class="input-addon">$</span>
					<input
                        v-model="currentBalance"
                        class="input-text"
                        type="number"
                        step="0.1"
                        @change="calculate"
                    >
				</div>
			</div>
			<div class="form-row">
				<label class="form-row--label">
                    {{ interestRateLabel }}
                </label>
				<div class="form-row--input input-addon--end">
					<input
                        v-model="interestRate"
                        class="input-text"
                        type="number"
                        step="0.1"
                        @change="calculate"
                    >
					<span class="input-addon">%</span>
				</div>
			</div>
			<div class="form-row">
				<label class="form-row--label">
                    {{ minimumPaymentLabel }}
                </label>
				<div class="form-row--input input-addon--start">
					<span class="input-addon">$</span>
					<input
                        v-model="minimumPayment"
                        class="input-text"
                        type="number"
                        step="0.1"
                        min="10"
                        @change="calculate"
                    >
				</div>
			</div>
		</div>
    </div>
</template>

<script>
import dayjs from 'dayjs'
import advancedFormat from 'dayjs/plugin/advancedFormat'
import relativeTime from 'dayjs/plugin/relativeTime'
import VueSlider from 'vue-slider-component'
import 'vue-slider-component/theme/antd.css'

export default {
    components: {
        VueSlider
    },

    props: {
        paymentLabel: {
            type: String,
            default: '',
        },
        currentBalanceLabel: {
            type: String,
            default: '',
        },
        interestRateLabel: {
            type: String,
            default: '',
        },
        minimumPaymentLabel: {
            type: String,
            default: '',
        }
    },

    data() {
        return {
            currentBalance: 2000,
            interestPaid: 0,
            interestRate: 5.4,
            minimumPayment: 150,
            payment: 150,
            payoffDate: null,
        }
    },

    computed: {
        payoffDateFormatted() {
            return dayjs(this.payoffDate).format('MMMM Do, YYYY')
        },
        payoffDateRelative() {
            return dayjs(this.payoffDate).fromNow()
        }
    },

    methods: {
        calculate() {
            let i = 0

            let interestPaid = 0
            let interestRate = this.interestRate / 100
            let date = dayjs()
            let currentBalance = this.currentBalance

            while (currentBalance > 0) {
                date = date.add(1, 'M')

                currentBalance -= this.payment
                currentBalance *= 1 + interestRate
                interestPaid += currentBalance * interestRate

                if (i > 960 || currentBalance >= Infinity) {
                    this.interestPaid = -1
                    return
                }
            }

            this.payoffDate = date
            this.interestPaid = interestPaid
        }
    },

    created() {
        dayjs.extend(relativeTime)
        dayjs.extend(advancedFormat)

        this.calculate()
    },

    watch: {
        payment(value) {
            this.calculate()
        }
    }
}
</script>
