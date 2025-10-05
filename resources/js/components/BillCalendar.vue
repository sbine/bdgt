<template>
  <vue-cal
    :events="events"
    :events-on-month-view="true"
    :views="['week', 'month']"
    :time="false"
    view="month"
    @ready="({ view }) => fetchEvents(view.start, view.end)"
    @view-change="(view) => fetchEvents(view.start, view.end)"
  >
    <template #title="{ title }">
      <h2 class="text-xl" v-html="title" />
    </template>

    <template #event="{ event }">
      <a
        :href="event.url"
        class="vuecal__event-title block text-white"
        :class="{
          'bg-green-500 border border-green-600': event.paid,
          'bg-red-600 border border-red-700': !event.paid,
        }"
        v-html="event.title"
      />
    </template>
  </vue-cal>
</template>

<script>
import axios from 'axios'
import dayjs from 'dayjs'
import { VueCal } from 'vue-cal'
import 'vue-cal/style'

export default {
  components: { VueCal },

  data() {
    return {
      events: [],
    }
  },

  methods: {
    fetchEvents(start, end) {
      axios
        .get('/bills/ajax_calendar_events', {
          params: {
            start: dayjs(start).format('YYYY-MM-DD'),
            end: dayjs(end).format('YYYY-MM-DD'),
          },
        })
        .then((response) => {
          this.events = response.data
        })
    },
  },
}
</script>
