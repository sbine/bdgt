<template>
    <canvas ref="chart"/>
</template>

<script>
import Chart from 'chart.js'

export default {
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
            axios.post('/reports/ajax/spending', {
                'startDate': '2019-01-01',
                'endDate': '2019-04-20',
            }).then(response => {
                this.datasets = response.data.datasets
                this.labels = response.data.labels
                this.chart.data.datasets = response.data.datasets
                this.chart.data.labels = response.data.labels

                let colors = Object.assign([], this.colors)

                this.chart.data.datasets.forEach(dataset => {
                    let randomColor = Math.floor(Math.random() * colors.length)

                    dataset.backgroundColor = colors[randomColor]
                    colors.splice(randomColor, 1)

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
