<template>
    <article class="action-button_container" v-if="getButtonAction">
        <router-link :to="{name: getButtonAction.routeName}">
            <button class="action_button" :disabled="getButtonAction.isDisabled">
                {{ getButtonAction.title }}
            </button>
        </router-link>
    </article>
</template>

<script>

import {eventBus} from "../main";

export default {
    name: "ButtonAction",

    computed: {
        getButtonAction() {
            return this.$store.getters.getButtonAction;
        }
    },

    methods: {
        animEvent() {
            this.fadeCart = false;
            eventBus.$emit('animEvent', {animFadeCart: this.fadeCart})
        }
    }
}
</script>

<style scoped>

.wrapper_button {
    margin: 0 auto;
    max-width: 18rem;
}

.action-button_container {
    max-width: 18rem;
    width: 100%;
    margin: 0 auto;
}

</style>