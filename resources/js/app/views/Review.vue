<template>
    <div class="container">

        <transition name="slide" mode="out-in">
            <back-button v-if="getProgress.current !== 0"/>
        </transition>

        <up-line-text/>

        <div class="cart_area">
            <back-cart-short v-if="getProgress.current < 3"/>

            <transition name="card-slide">
                <router-view></router-view>
            </transition>
        </div>

        <progress-point/>

        <button-action/>
    </div>
</template>

<script>

import BackButton from "../components/BackButton";
import UpLineText from "../components/UpLineText";
import ButtonAction from "../components/ButtonAction";
import ProgressPoint from "../components/ProgressPoint";
import BackCartShort from "../components/BackCartShort";
import geolocation from "../mixins/geolocation";

export default {
    name: "Review",

    beforeMount() {
        navigator.permissions.query({name: 'geolocation'}).then((result) => {
            this.geolocationHandler(result)
        });
    },

    computed: {
        getProgress() {
            return this.$store.getters.getProgress
        }
    },

    components: {BackCartShort, ProgressPoint, ButtonAction, UpLineText, BackButton},

    mixins: [geolocation]
}

</script>

<style scoped>

.container {
    max-width: 18rem;
    margin: auto;
}

.cart_area {
    position: relative;
    height: 25.4rem;
}

.slide-enter-active, .slide-leave-active {
    transition: top .35s;
}

.slide-enter, .slide-leave-to {
    top: -1rem;
}

.card-slide-enter-active, .card-slide-leave-active {
    transition: .75s;
}

.card-slide-enter {
    transform: scale(.75);
    top: -2.5rem !important;
}

.card-slide-enter-to {
    transform: scale(1);
    top: 1.8rem;
}

/*.card-slide-enter, .card-slide-enter-active {
    transform: scale(.75);
    top: -2rem;
}*/

.card-slide-leave-active {
    z-index: 100;
}

.card-slide-leave-to {
    transform: translateX(-200%) rotateZ(-45deg);
    opacity: 0;
}

</style>
