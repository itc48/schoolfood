<template>
    <!--компонент задняя карта, конец-->
    <div class="desck_shortcard_back"></div>
</template>

<script>
    export default {
        name: "BackCartShort"
    }
</script>

<style scoped>
    /*компонент задняя карта, конец*/
    .desck_shortcard_back{
        max-width: 18rem;
        width: 100%;
        height: 21rem;
        margin:0 auto;
        top: -2.5rem;
        padding-bottom:1rem;
        background-color:#ffff;
        box-shadow: 0px -5px 15px 2px rgba(0, 0, 0, 0.1);
        border-radius: 1.25rem;
        position: relative;
        transform: scale(.75);
    }
</style>