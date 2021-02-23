<template>
    <div class="w-full max-w-6xl mx-auto">
        <v-date-picker
            class="absolute right-0 mr-6"
            style="min-width: 210px"
            mode="range"
            v-model="range"
            @input="fetchData"
            :popover="{ placement: 'bottom', visibility: 'click' }"
        />

        <h1 class="w-full md:text-center text-gray-800 text-xl mb-1">
            {{ $t('labels.reports.spending_over_time') }}
        </h1>

        <h2 class="w-full md:text-center font-bold text-gray-700 text-lg mb-6">{{ total }}</h2>

        <apexchart type="bar" :options="chartOptions" :series="datasets" />
    </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
import dayjs from 'dayjs'
import colors from './ReportColors'
import { formatMoney } from '../../utils'

export default {
    components: { apexchart: VueApexCharts, 'v-date-picker': DatePicker },

    props: {
        url: String,
    },

    data() {
        return {
            datasets: [],
            total: 0,
            chartOptions: {
                colors: colors,
                /*
                responsive: [{
                    breakpoint: 788,
                    options: {
                        chart: {
                            height: 1000,
                        },
                        legend: {
                            position: 'top',
                        },
                    }
                }],
                */
                chart: {
                    fontFamily: null,
                    stacked: true,
                },
                dataLabels: {
                    enabled: false,
                    dropShadow: {
                        enabled: false,
                    },
                },
                legend: {
                    formatter: (seriesName, options) => {
                        return ['<span>' + seriesName + '</span>', ' ', '<b class="apexcharts-legend-amount">' + formatMoney(options.w.globals.series[options.seriesIndex].reduce((a, b) => a + b)) + '</b>']
                    },
                    position: 'right',
                },
                states: {
                    active: {
                        filter: {
                            type: 'none',
                        }
                    },
                    hover: {
                        filter: {
                            type: 'darken',
                            value: 0.85,
                        }
                    },
                },
                tooltip: {
                    shared: true,
                    onDatasetHover: {
                        highlightDataSeries: false,
                    },
                    y: {
                        formatter: (value) => formatMoney(value)
                    },
                },
                yaxis: {
                    labels: {
                        formatter: (value) => formatMoney(value)
                    }
                }
            },
            range: {
                start: dayjs().subtract(1, 'year').toDate(),
                end: dayjs().toDate(),
            },
        }
    },

    mounted() {
        this.fetchData()
    },

    methods: {
        fetchData() {
            axios.post(this.url, {
                'startDate': this.range.start,
                'endDate': this.range.end,
            }).then(response => {
                const startDate = new Date(response.data.startDate)
                const endDate = new Date(response.data.endDate)
                // If dates have changed, overwrite them
                if (this.range.end > endDate || this.range.end < endDate) {
                    this.range = {
                        start: startDate,
                        end: endDate,
                    }
                }

                this.datasets = response.data.data.datasets
                this.total = formatMoney(response.data.data.total)

                this.chartOptions = {
                    ...this.chartOptions, ...{
                        labels: response.data.data.labels,
                    }
                }
            })
        }
    }
}
</script>
