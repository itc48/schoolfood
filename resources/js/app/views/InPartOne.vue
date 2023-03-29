<template>
    <short-cart :titleTexts="titleTexts">
        <estimation-good-bad/>
    </short-cart>
</template>

<script>
    import ShortCart from "../components/ShortCart";
    import EstimationGoodBad from "../components/EstimationGoodBad";

    export default {
        name: "InPartOne",
        data() {
            return {
                titleTexts: [
                    {id: 1, text: 'Оцените качество'},
                    {id: 2, text: 'обеда в столовой'}
                ],
            }
        },
        components: {
            EstimationGoodBad,
            ShortCart
        },
    }
</script>

<style scoped>

</style>