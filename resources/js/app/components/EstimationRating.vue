<template>
    <!--компонент оценки-->
    <fieldset class="wrapper_estimation">
        <input class="rating_point" type="radio" name="food" value="1" aria-label="Не съедобно" checked @change="getValueInput">
        <input class="rating_point" type="radio" name="food" value="2" aria-label="Ужасно" @change="getValueInput">
        <input class="rating_point" type="radio" name="food" value="3" aria-label="Удовлетворительно" @change="getValueInput">
        <input class="rating_point" type="radio" name="food" value="4" aria-label="Хорошо" @change="getValueInput">
        <input class="rating_point" type="radio" name="food" value="5" aria-label="Отлично" @change="getValueInput">
    </fieldset>
</template>

<script>
    import {eventBus} from '../main';
    export default {
        name: "EstimationRating",
        data(){
            return {
                estimationIndex:null,
            }
        },
        methods:{
            getValueInput(event){
                eventBus.$emit('EstimationRating', {estimationIndex: event.target.value});
                localStorage.setItem('rating', event.target.value);
            }
        }
    }
</script>

<style scoped>
    /*компонент оценки*/
    .wrapper_estimation{
        border:none;
        position:relative;
        width:12.5rem;
        height:2rem;
        padding:0;
        background-image:url("../../public/media/img/backgroundimages/soup_rating.svg");
        background-size:2.5rem;

    }

    .rating_point{
        position: absolute;
        margin:0;
        top:0;
        left:0;
        height:2rem;
        background-size:2.5rem;
        border:none;
        appearance: none;
        -moz-appearance: none;
        -webkit-appearance: none;
    }

    .rating_point:focus{
        outline: none;
    }

    .rating_point:checked{
        background-image:url("../../public/media/img/backgroundimages/onsoup_rating.svg");

    }

    .rating_point:nth-of-type(1){
        width:2.5rem;
        z-index:5;
    }

    .rating_point:nth-of-type(2){
        width:5rem;
        z-index:4;
    }

    .rating_point:nth-of-type(3){
        width:7.5rem;
        z-index:3;
    }

    .rating_point:nth-of-type(4){
        width:10rem;
        z-index:2;
    }

    .rating_point:nth-of-type(5) {
        width: 12.5rem;
        z-index: 1;
    }
</style>