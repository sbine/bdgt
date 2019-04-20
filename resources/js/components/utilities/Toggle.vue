<template>
    <div v-on-clickaway="blur">
        <slot
            :is-on="isOn"
            :set-to="setTo"
            :toggle="toggle"
        />
    </div>
</template>

<script>
import { mixin as clickaway } from 'vue-clickaway'

export default {
    mixins: [ clickaway ],

    props: {
        closeOnBlur: { type: Boolean },
    },

    data() {
        return {
            isOn: false,
        }
    },

    methods: {
        setTo(value) {
            this.isOn = !! value
        },
        toggle() {
            this.isOn = ! this.isOn
        },
        blur() {
            if (this.closeOnBlur) {
                this.setTo(false)
            }
        }
    }
}
</script>
