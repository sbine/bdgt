<template>
    <div
        v-show="value"
        class="fixed left-0 top-0 w-screen h-screen overflow-y-scroll z-50"
        style="background-color: hsla(0, 0%, 0%, 0.3)"
        @click="hide"
    >
        <div
            class="relative w-5/6 md:w-4/6 xl:w-3/6 bg-white text-gray-900 rounded-sm shadow-xl mx-auto my-8"
            @click.stop
        >
            <div
                class="absolute cursor-pointer right-0 top-0 mr-2 xl:mr-4"
                @click="hide"
            >
                <div class="text-4xl text-gray-600 hover:text-gray-700">
                    <font-awesome-icon icon="times" class="pr-2"></font-awesome-icon>
                </div>
            </div>

            <slot/>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: Boolean,
    },

    methods: {
        hide() {
            this.$emit('input', false)
        }
    }
}
</script>
