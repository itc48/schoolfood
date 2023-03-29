<template>
    <div id="app">
        <transition name="fade" mode="out-in">
            <router-view v-if="getSchool"></router-view>

            <loading v-else-if="getSchool === null"/>

            <not-found404 v-else-if="getSchool === undefined"/>
        </transition>
    </div>
</template>

<script>
import NotFound404 from "./views/NotFound404";
import Loading from "./views/Loading";

export default {
    name: 'App',

    data() {
        return {
            test: null
        }
    },

    mounted() {
        this.$store.dispatch('requestSchool', this.$route.params.school_uuid);

        if (localStorage.selectedFile) {
            this.test = localStorage.selectedFile;
        }
    },

    computed: {
        getSchool() {
            return this.$store.getters.getSchool;
        }
    },

    components: {
        Loading,
        NotFound404
    },
}

</script>

<style>

.action_button {
    width: 100%;
    background-color: #FF5F33;
    border-radius: .6rem;
    border: 0px;
    height: 3.25rem;
    color: #fff;
    font-size: 1.1rem;
    font-weight: 500;
    font-family: ptrootui;
    transition: .35s;
    cursor: pointer;
}

.action_button:disabled {
    background-color: #adacac;
    color: black;
    cursor: unset;
}

.center__message {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.error-text {
    color: red;
    text-align: center;
}

.fade-enter-active, .fade-leave-active {
    transition: opacity .35s;
}

.fade-enter, .fade-leave-to {
    opacity: 0;
}

</style>
