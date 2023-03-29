<template>
        <!--компонент с карточками, версия лонг, которая с девочкой-->
        <div class="desck_card_front">
            <h1>Помоги нам сделать<br> твои обеды лучше</h1>
            <div class="circul">
                <img src="/media/img/soupindex.svg" class="circul_backgroundgirl">
                <img src="/media/img/backgroundimages/circle.svg" class="circul_backgroundcircle">
            </div>
        </div>
</template>
<script>
    export default {
        name: "LongCart"
    }
</script>

<style scoped>
    /*компонент с карточками, версия лонг, которая с девочкой*/
    .desck_card_front{
        max-width:18rem;
        width:100%;
        margin: 0 auto;
        padding-top:1.2rem;
        background-color:#ffff;
        box-shadow: 0px -5px 15px 2px rgba(0, 0, 0, 0.1);
        border-radius: 1.25rem;
        position: absolute;
        top: 2rem;
    }

    .desck_card_front h1{
        text-align:center;
        font-family:ptrootuibold;
        font-size:1.1rem;
        font-style:normal;
        font-weight:800;
        color:rgb(79, 79, 79);
        margin:0;
    }

    .circul{
        display:flex;
        flex-direction:column;
        align-items:center;
        position:relative;
        padding:3.125rem 0 3.75rem 0;
    }

    .circul_backgroundgirl{
        position:relative;
        z-index:2;
    }

    .circul_backgroundcircle{
        position:absolute;
        z-index:1;
        top: 25%;
    }
</style>