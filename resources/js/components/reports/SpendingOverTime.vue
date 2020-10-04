<template>
    <canvas ref="chart"/>
</template>

<script>
import Chart from 'chart.js'
import dayjs from 'dayjs'

export default {
    props: {
        url: String,
    },

    data() {
        return {
            chart: null,
            datasets: [],
            labels: [],
            colors: [ // 11 colours total
                '#AECDE1',
                '#3A77AF',
                '#BBDD93',
                '#549D3F',
                '#EE9F9B',
                '#D1352B',
                '#F5C07B',
                '#F08532',
                '#C6B4D3',
                '#926BB7',
                '#F1A0F9',
                '#F19FCA'
            ],
        }
    },

    mounted() {
        this.initialize()
        this.fetchData()
    },

    methods: {
        fetchData() {
            axios.post(this.url, {
                'startDate': dayjs().subtract(1, 'year').format('YYYY-MM-DD'),
                'endDate': dayjs().format('YYYY-MM-DD'),
            }).then(response => {
                this.datasets = response.data.datasets
                this.labels = response.data.labels
                this.chart.data.datasets = response.data.datasets
                this.chart.data.labels = response.data.labels

                let colors = Object.assign([], this.colors)

                this.chart.data.datasets.forEach(dataset => {
                    dataset.backgroundColor = colors[0]
                    colors.splice(colors[0], 1)

                    if (! colors.length) {
                        colors = Object.assign([], this.colors)
                    }
                })

                this.chart.update()
            })
        },
        initialize() {
            this.chart = new Chart(this.$refs.chart.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: this.labels,
                    datasets: this.datasets,
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Spending Over Time',
                    },
                    tooltips: {
                        mode: 'label',
                        callbacks: {
                            label(tooltipItems, data) {
                                return data.datasets[tooltipItems.datasetIndex].label +': ' + '$' + tooltipItems.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            }
                        }
                    },
                    scales: {
                        xAxes: [{
                            stacked: true,
                        }],
                        yAxes: [{
                            stacked: true,
                            ticks: {
                                callback(label) {
                                    return  '$' + label.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                }
                            }
                        }]
                    }
                }
            })
        }
    }
}
</script>
