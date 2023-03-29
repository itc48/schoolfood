<template>
    <short-cart :titleTexts="titleTexts">
        <button-photo/>
    </short-cart>
</template>

<script>

import ShortCart from "../components/ShortCart";
import ButtonPhoto from "../components/ButtonPhoto";

export default {
    name: "PartTwo",

    data() {
        return {
            titleTexts: [
                {id: 1, text: 'Сфотографируй еду'},
            ]
        }
    },

    created() {
        this.$store.commit('setProgress', 2);
        this.$store.commit('setButtonAction', {
            isDisabled: false,
            title: 'Добавить фото',
            routeName: 'PartThree',
            progress: 2
        });
    },

    components: {
        ShortCart, ButtonPhoto
    }
}
</script>

<style scoped>

</style>