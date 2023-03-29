<template>
    <div class="arrow_back" @click="$router.go(-1)">
        <p>
            <img src="/media/img/arrow_back.svg">
            Назад
        </p>
    </div>
</template>

<script>

    export default {
        name: "BackButton",
    }

</script>

<style scoped>

    .arrow_back {
        position: absolute;
        top: .1rem;
        left: 0;
        width: 100%;
        cursor: pointer;
    }

    .arrow_back p {
        color: #F68741;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }

</style>