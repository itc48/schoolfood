<template>
    <short-cart :titleTexts="titleTexts">
        <img src="/media/img/backgroundimages/thanks.svg">
    </short-cart>
</template>

<script>

import ShortCart from "../components/ShortCart";
import store from "../store/index";

export default {
    name: "PartEnd",

    data() {
        return {
            titleTexts: [
                {
                    id: 1,
                    text: 'Спасибо'
                },
                {
                    id: 2,
                    text: 'за вашу оценку'
                }
            ],
        }
    },

    beforeRouteEnter(to, from, next) {
        if (store.getters.getScore === -1 || store.getters.getScore === 1) {
            return next();
        } else {
            return next({
                name: 'PartOne'
            });
        }
    },

    created() {
        this.$store.commit('setProgress', 3);
        this.$store.commit('setButtonAction', {
            isDisabled: false,
            title: 'Выйти',
            routeName: 'ReviewIndex',
            progress: 1
        });

        this.$store.dispatch('sendReview', this.$route.params.school_uuid);
    },

    components: {
        ShortCart,
    }
}
</script>

<style scoped>

</style>