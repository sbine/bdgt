<template>
    <div class="w-full max-w-6xl mx-auto">
        <h1 class="w-full text-center text-gray-800 text-xl mb-6">
            Spending Over Time
        </h1>
        <apexchart type="bar" :options="chartOptions" :series="datasets" />
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
            chartOptions: {
                colors: colors,
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
                chart: {
                    stacked: true,
                },
                dataLabels: {
                    enabled: false,
                    dropShadow: {
                        enabled: false,
                    },
                },
                legend: {
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
            }
        }
    },

    mounted() {
        this.fetchData()
    },

    methods: {
        fetchData() {
            axios.post(this.url, {
                'startDate': dayjs().subtract(1, 'year').format('YYYY-MM-DD'),
                'endDate': dayjs().format('YYYY-MM-DD'),
            }).then(response => {
                this.datasets = response.data.datasets

                this.chartOptions = {
                    ...this.chartOptions, ...{
                        labels: response.data.labels,
                    }
                }
            })
        }
    }
}
</script>
