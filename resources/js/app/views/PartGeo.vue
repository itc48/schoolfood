<template>
    <short-cart :titleTexts="titleTexts" v-if="animFadeCart" class="card">
        <button @click="enableGeolocation" class="action_button">
            Включить геолокацию
        </button>

        <p class="error-text" v-if="getErrorText">
            {{ getErrorText }}
        </p>
    </short-cart>
</template>

<script>

import ShortCart from "../components/ShortCart";
import store from "../store/index";
import geolocation from "../mixins/geolocation";

export default {
    name: "PartGeo",

    data() {
        return {
            titleTexts: [
                {id: 1, text: 'Для рецензии'},
                {id: 2, text: 'необходимо включить'},
                {id: 3, text: 'геолокацию'}
            ],
            animFadeCart: true
        }
    },

    beforeRouteEnter(to, from, next) {
        if (!store.getters.getCoordinates) {
            return next();
        } else {
            return next({
                name: 'PartOne'
            });
        }
    },

    mounted() {
        this.$store.commit('setProgress', 1);
        this.$store.commit('setButtonAction', {
            isDisabled: true,
            title: 'Начать',
            routeName: 'PartOne',
            progress: 1
        })
    },

    methods: {
        enableGeolocation() {
            this.getCurrentPosition()
            navigator.permissions.query({name: 'geolocation'}).then((result) => {
                this.getCurrentPosition()
            });
        },

        getCurrentPosition() {
            navigator.geolocation.getCurrentPosition((e) => {
                this.$store.commit('setCoordinates', e.coords)
                this.$store.commit('setButtonAction', {
                    isDisabled: false,
                    title: 'Начать',
                    routeName: 'PartOne',
                    progress: 1
                })
                this.$store.commit('setErrorText', '')
            }, (e) => {
                this.$store.commit('setErrorText', 'В целях безопасности, необходимо разрешить доступ к геолокации в настройках Вашего устройства')
            })
        }
    },

    computed: {
        getErrorText() {
            return this.$store.getters.getErrorText
        },
        getCoordinates() {
            return this.$store.getters.getCoordinates
        },
    },

    components: {
        ShortCart,
    },

    mixins: [geolocation]
}
</script>

<style scoped>

.action_button {
    width: 90%;
}

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