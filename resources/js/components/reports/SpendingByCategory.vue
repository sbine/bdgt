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
            colors: [
                '#4D4D4D',
                '#5DA5DA',
                '#FAA43A',
                '#60BD68',
                '#F17CB0',
                '#B2912F',
                '#B276B2',
                '#DECF3F',
                '#F15854',
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
                'startDate': dayjs().subtract(1, 'month').format('YYYY-MM-DD'),
                'endDate': dayjs().format('YYYY-MM-DD'),
            }).then(response => {
                this.datasets = response.data.datasets
                this.labels = response.data.labels
                this.chart.data.datasets = response.data.datasets
                this.chart.data.labels = response.data.labels

                let colors = Object.assign([], this.colors)
                let backgroundColors = []

                this.chart.data.datasets.forEach(dataset => {
                    dataset.data.forEach(data => {
                        let randomColor = Math.floor(Math.random() * colors.length)
                        backgroundColors.push(colors[randomColor])
                        colors.splice(randomColor, 1)

                        if (! colors.length) {
                            colors = Object.assign([], this.colors)
                        }
                    })

                    dataset.backgroundColor = backgroundColors
                })

                this.chart.update()
            })
        },
        initialize() {
            this.chart = new Chart(this.$refs.chart.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: this.labels,
                    datasets: this.datasets,
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Spending By Category (This Month)'
                    },
                    tooltips: {
                        mode: 'label',
                        callbacks: {
                            label(tooltipItems, data) {
                                return data.labels[tooltipItems.index] +': ' + '$' + data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                            }
                        }
                    }
                }
            })
        }
    }
}
</script>
