<template>
    <div class="w-full max-w-5xl mx-auto">
        <h1 class="w-full text-center text-gray-800 text-xl mb-6">
            Spending by Category (This Month)
        </h1>
        <apexchart type="pie" :options="chartOptions" :series="datasets" />
    </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts'
import dayjs from 'dayjs'
import colors from './ReportColors'
import { formatMoney } from '../../utils'

export default {
    components: { apexchart: VueApexCharts },

    props: {
        url: String,
    },

    data() {
        return {
            datasets: [],
            labels: [],
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
                dataLabels: {
                    enabled: false,
                    dropShadow: {
                        enabled: false,
                    },
                },
                legend: {
                    formatter: (seriesName, options) => {
                        return ['<span>' + seriesName + '</span>', ' ', '<b class="apexcharts-legend-amount">$' + options.w.globals.series[options.seriesIndex]?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') + '</b>']
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
            }
        }
    },

    mounted() {
        this.fetchData()
    },

    methods: {
        fetchData() {
            axios.post(this.url, {
                'startDate': dayjs().subtract(1, 'month').format('YYYY-MM-DD'),
                'endDate': dayjs().format('YYYY-MM-DD'),
            }).then(response => {
                this.datasets = response.data.datasets

                this.chartOptions = {
                    ...this.chartOptions, ...{
                        labels: response.data.labels,
                    }
                }
            })
        },
    }
}
</script>
