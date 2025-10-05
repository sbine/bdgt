<template>
  <div class="w-full max-w-6xl mx-auto relative">
    <v-date-picker
      style="min-width: 220px"
      mode="date"
      v-model.range="range"
      @update:modelValue="fetchData"
      @ready="fetchData"
      :popover="{ placement: 'bottom', visibility: 'click' }"
    >
      <template v-slot="{ inputEvents }">
        <div class="absolute right-0 md:mr-6 flex justify-center items-center">
          <input type="text" class="input-text" :value="formatDate(range.start)" v-on="inputEvents.start" />
          <span class="px-2">-</span>
          <input type="text" class="input-text" :value="formatDate(range.end)" v-on="inputEvents.end" />
        </div>
      </template>
    </v-date-picker>

    <h1 class="w-full md:text-center text-gray-800 text-xl mb-1">
      {{ $t('labels.reports.spending_by_category') }}
    </h1>

    <h2 class="w-full md:text-center font-bold text-gray-700 text-lg mb-6">{{ total }}</h2>

    <div v-show="!datasets.length > 0" class="text-center">No results for time period</div>
    <apexchart v-show="!!datasets.length > 0" type="pie" :options="chartOptions" :series="datasets" />
  </div>
</template>

<script>
import axios from 'axios'
import VueApexCharts from 'vue3-apexcharts'
import { DatePicker } from 'v-calendar'
import 'v-calendar/style.css'
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
      chartOptions: {
        colors: colors,
        /*
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
                */
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
            return [
              '<span>' + seriesName + '</span>',
              ' ',
              '<b class="apexcharts-legend-amount">' +
                formatMoney(options.w.globals.series[options.seriesIndex]) +
                '</b>',
            ]
          },
          position: 'right',
        },
        states: {
          active: {
            filter: {
              type: 'darken',
              value: 0.75,
            },
          },
          hover: {
            filter: {
              type: 'darken',
              value: 0.85,
            },
          },
        },
        tooltip: {
          onDatasetHover: {
            highlightDataSeries: false,
          },
          y: {
            formatter: (value) => formatMoney(value),
          },
        },
      },
      range: {
        start: dayjs().startOf('year').toDate(),
        end: dayjs().endOf('month').toDate(),
      },
    }
  },

  computed: {
    total() {
      return formatMoney(!!this.datasets.length ? this.datasets.reduce((a, b) => a + b) : 0)
    },
  },

  mounted() {
    this.fetchData()
  },

  methods: {
    formatDate(date) {
      return dayjs(date).format('MM/DD/YYYY')
    },
    fetchData() {
      axios
        .post(this.url, {
          startDate: this.range.start,
          endDate: this.range.end,
        })
        .then((response) => {
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

          this.chartOptions = {
            ...this.chartOptions,
            ...{
              labels: response.data.data.labels,
            },
          }
        })
    },
  },
}
</script>
