<template>
    <article class="progresspoint_container">
        <div class="wrapper_point">
            <div class="point" v-for="point in getProgress.total"
                 :key="point"
                 :class="{pointColor: point <= getProgress.current}"></div>
        </div>
    </article>
</template>

<script>

    export default {
        name: "ProgressPoint",
        computed: {
            getProgress() {
                return this.$store.getters.getProgress;
            }
        }
    }

</script>

<style scoped>

    .progresspoint_container {
        max-width: 18rem;
        width: 100%;
        margin: 0 auto;
    }

    .wrapper_point {
        width: 5rem;
        margin: 0 auto;
        display: flex;
        justify-content: space-around;
        padding: 1.6rem 0;
    }

    .point {
        width: 1.1rem;
        height: 1.1rem;
        background-color: #DADADA;
        border-radius: 50%;
        transition: .35s;
    }

    .pointColor {
        width: 1.1rem;
        height: 1.1rem;
        background-color: rgb(255, 95, 51);
        border-radius: 50%;
    }

</style>