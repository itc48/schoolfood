<template>
    <short-cart>
        <h1>Помоги нам сделать<br> твои обеды лучше</h1>
        <div class="bakcgroundsoup">
            <img src="/media/img/soupindex.svg" class="circul_backgroundgirl">
        </div>
    </short-cart>
</template>

<script>

import ShortCart from '../components/ShortCart';

export default {
    name: "index",

    mounted() {
        this.$store.commit('setProgress', 0);
        this.$store.commit('setButtonAction', {
            isDisabled: false,
            title: 'Начать',
            routeName: this.getCoordinates ? 'PartOne' : 'PartGeo',
            progress: 1
        })
    },

    computed: {
        getCoordinates() {
            return this.$store.getters.getCoordinates
        },
    },

    components: {
        ShortCart,
    }
}
</script>

<style scoped>

.bakcgroundsoup {
    padding-top: 2rem;
}

</style>