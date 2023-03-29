<template>
    <short-cart :titleTexts="titleTexts" v-if="animFadeCart">
        <estimation-good-bad/>
    </short-cart>
</template>

<script>

import ShortCart from "../components/ShortCart";
import EstimationGoodBad from "../components/EstimationGoodBad";
import {eventBus} from "../main";

export default {
    name: "PartOne",

    data() {
        return {
            titleTexts: [
                {id: 1, text: 'Оцените качество'},
                {id: 2, text: 'обеда в столовой'}
            ],
            eventActionFlag: null,
            animFadeCart: true
        }
    },

    mounted() {
        this.$store.commit('setProgress', 1);
        this.$store.commit('setButtonAction', {
            isDisabled: true,
            title: 'Проголосуй!',
            routeName: 'PartTwo',
            progress: 2
        });
    },

    created() {
        eventBus.$on('eventActionFlag', data => {
            this.eventActionFlag = data.eventActionFlag;
            console.log(this.eventActionFlag)
        });
    },

    components: {
        EstimationGoodBad,
        ShortCart,
    }
}
</script>

<style scoped>

.fadeCart-enter-active {
    animation: bounce-in .5s;
    transition: all 400ms ease-out;
}

.fadeCart-leave-active {
    animation: bounce-in .5s reverse;
    transition: all 400ms ease-out;
}

@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.5);
    }
}
</style>