<template>
    <!--компонент с карточками, версия шорт-->
    <div class="desck_shortcard_front">
        <h1 v-for="titleText of titleTexts" :key="titleText.id">
            {{titleText.text}}<br>
        </h1>

        <div class="wrapper_actionzone">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['titleTexts'],
        name: "ShortCart",
        data() {
            return {
                text: null
            }
        }
    }
</script>

<style scoped>
    /*компонент с карточками, версия шорт*/

    .desck_shortcard_front {
        max-width: 18rem;
        width: 100%;
        height: 21rem;
        margin: 0 auto;
        padding-top: 1.2rem;
        padding-bottom: 1.2rem;
        background-color: #ffff;
        box-shadow: 0px -5px 15px 2px rgba(0, 0, 0, 0.1);
        border-radius: 1.25rem;
        position: absolute;
        top: 2rem;
    }

    .desck_shortcard_front h1 {
        text-align: center;
        font-family: ptrootuibold;
        font-size: 1.1rem;
        font-style: normal;
        font-weight: 800;
        color: rgb(79, 79, 79);
        margin: 0;
    }

    .wrapper_actionzone {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 18rem;
    }
</style>