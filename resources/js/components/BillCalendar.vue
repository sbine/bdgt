<template>
  <vue-cal
    :events="events"
    :disable-views="['years', 'year', 'day']"
    :time="false"
    default-view="month"
    events-on-month-view="short"
    @ready="fetchEvents($event.startDate, $event.endDate)"
    @view-change="fetchEvents($event.startDate, $event.endDate)"
  >
    <div slot="no-event" />

    <template #title="{ title }">
      <h2 class="text-xl">{{ title }}</h2>
    </template>

    <template #event-renderer="{ event }">
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
import dayjs from 'dayjs'
import VueCal from 'vue-cal'
import 'vue-cal/dist/vuecal.css'

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
