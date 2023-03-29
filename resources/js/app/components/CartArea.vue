<template>
    <main class="deck_container">
        <slot>

        </slot>
    </main>
</template>

<script>
    export default {
        name: "CartArea"
    }
</script>

<style scoped>
    .deck_container{
        max-width:18rem;
        width:100%;
        margin: 0 auto;
        position:relative;
    }
</style>