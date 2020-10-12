<template>
    <div class="w-full max-w-5xl mx-auto">
        <h1 class="w-full text-center text-gray-800 text-xl mb-1">
            {{ $t('labels.reports.spending_by_category') }} (This Month)
        </h1>

        <h2 class="w-full text-center font-bold text-gray-700 text-lg mb-6">{{ total }}</h2>
        <div class="flex justify-end">
            <span style="min-width: 220px;">
                <v-date-picker
                    mode='range'
                    v-model='range'
                    @input="fetchData"
                    :popover="{ placement: 'bottom', visibility: 'click' }"
                >
                </v-date-picker>
            </span>
        </div>
        <apexchart type="pie" :options="chartOptions" :series="datasets" />
    </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts'
import DatePicker from 'v-calendar/lib/components/date-picker.umd'
import colors from './ReportColors'
import { formatMoney } from '../../utils'
let currentDate= new Date();
export default {
    components: { apexchart: VueApexCharts , 'v-date-picker': DatePicker },

    props: {
        url: String,
    },

    data() {
        return {
            datasets: [],
            chartOptions: {
                colors: colors,
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 700,
                        },
                        legend: {
                            position: 'top',
                        },
                    }
                }, {
                    breakpoint: 680,
                    options: {
                        chart: {
                            height: 800,
                        },
                        legend: {
                            position: 'top',
                        },
                    }
                }],
                chart: {
                    fontFamily: null,
                },
                dataLabels: {
                    enabled: false,
                    dropShadow: {
                        enabled: false,
                    },
                },
                legend: {
                    formatter: (seriesName, options) => {
                        return ['<span>' + seriesName + '</span>', ' ', '<b class="apexcharts-legend-amount">' + formatMoney(options.w.globals.series[options.seriesIndex]) + '</b>']
                    },
                    position: 'right',
                },
                states: {
                    active: {
                        filter: {
                            type: 'darken',
                            value: 0.75,
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
                    onDatasetHover: {
                        highlightDataSeries: false,
                    },
                    y: {
                        formatter: (value) => formatMoney(value)
                    },
                }
            },
            currentDate : new Date(),
            range: {
                start: new Date(currentDate.getFullYear(), 0, 1), //starting date of the current year
                end: new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0) //ending date of the current month
            },
            maxDate: null
        }
    },

    computed: {
        total() {
            return formatMoney(!! this.datasets.length
                ? this.datasets.reduce((a, b) => a + b)
                : 0)
        }
    },

    mounted() {
        this.fetchData()
    },

    methods: {
        fetchData() {
            axios.post(this.url, {
                'startDate': this.range.start,
                'endDate':  this.range.end,
            }).then(response => {
                this.datasets = response.data.chart.datasets

                this.chartOptions = {
                    ...this.chartOptions, ...{
                        labels: response.data.chart.labels,
                    }
                }

                this.range.end = response.data.endDate;
            })
        },
    }
}
</script>
