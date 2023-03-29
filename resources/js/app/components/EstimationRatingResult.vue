<template>
    <!--компонент вывода оценки числом-->
    <p>
        Ваша оценка
                    <i class="number" v-if="test == null">1</i>
                    <i calss="number" v-else>{{test}}</i>
                    /5
    </p>
</template>

<script>
    import {eventBus} from '../main';
    export default {
        name: "EstimationRatingResult",
        data(){
            return{
                test:null
            }
        },
        mounted (){
            eventBus.$on('EstimationRating', data =>{
                this.test = data.estimationIndex
            })
        },
        beforeDestroy() {
            eventBus.$off('EstimationRating', data =>{
                this.test = data.estimationIndex
            })
        }
    }
</script>

<style scoped>
    /*компонент вывода оценки числом*/
    .number{
        font-style:normal;
    }
</style>