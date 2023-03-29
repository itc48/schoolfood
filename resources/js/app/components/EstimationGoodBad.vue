<template>
    <div class="estimationWrapBadGood">
        <fieldset class="goodBadEstimation">
            <label class="estimationWrapperPoint" @click="showEstimationBad = !showEstimationBad">
                <transition name="estimationBadAnimate">
                    <img v-if="showEstimationBad" :src="'/media/img/' + pathImageBad" class="badEstimation">
                </transition>
                <input type="radio" name="estimationWrapperPoint" class="radioEstimation" aria-label="Плохо"
                       @change="getEstimation" value="-1">
            </label>

            <label class="estimationWrapperPoint" @click="showEstimationGood = !showEstimationGood">
                <transition name="estimationGoodAnimate">
                    <img v-if="showEstimationGood" :src="'/media/img/' + pathImageGood" class="goodEstimation">
                </transition>
                <input type="radio" name="estimationWrapperPoint" class="radioEstimation" aria-label="Классно"
                       @change="getEstimation" value="1">
            </label>
        </fieldset>
        <div class="textAnswer">
            <p>
                {{ addFirstString }}<br>
                <strong>{{ addSecondString }}</strong>
            </p>
        </div>
    </div>
</template>

<script>

import {eventBus} from "../main";

export default {
    name: "EstimationGoodBad",

    data() {
        return {
            pathImageBad: "badestimationgrey.svg",
            pathImageGood: "goodestimationgrey.svg",
            addFirstString: "Выбери,",
            addSecondString: "как тебе еда в столовой?",
            showEstimationBad: true,
            showEstimationGood: true
        }
    },

    methods: {
        getEstimation(event) {
            if (event.target.value == 1) {
                this.pathImageGood = "goodestimationcolor.svg";
                this.pathImageBad = "badestimationgrey.svg";
                this.addFirstString = "Мне понравилось!";
                this.addSecondString = "Сегодня было вкусно!";

                eventBus.$emit('eventActionFlag', {eventActionFlag: event.target.value}) // установил сохранение события в эвент бас для изменения пользовательского пути в зависимости от выбора

                this.$store.commit('setScore', 1);
            } else {
                this.pathImageGood = "goodestimationgrey.svg";
                this.pathImageBad = "badestimationcolor.svg";
                this.addFirstString = "Мне не понравилось!";
                this.addSecondString = "Сегодня было плохо!";

                eventBus.$emit('eventActionFlag', {eventActionFlag: event.target.value}) // установил сохранение события в эвент бас для изменения пользовательского пути в зависимости от выбора

                this.$store.commit('setScore', -1);
            }

            this.$store.commit('setButtonAction', {
                isDisabled: false,
                title: 'Дальше!',
                routeName: event.target.value == 1 ? 'PartThree' : 'PartTwo',
                progress: 2
            });
        }
    }
}

</script>

<style scoped>

.badEstimation, .goodEstimation {
    cursor: pointer;
}

.goodBadEstimation {
    width: 12.5rem;
    display: flex;
    justify-content: space-between;
    padding: 0;
    margin: 0;
    border: none;
}

.estimationWrapperPoint {
    display: flex;
    flex-direction: column
}

.radioEstimation {
    visibility: hidden;
}

.textAnswer {
    padding-top: .5rem;
    color: #4F4F4F;
}

.textAnswer p {
    margin: 0;
    min-height: 1rem;
    text-align: center;
}

.estimationBadAnimate-enter-active {
    animation: bounce-in .5s;
}

.estimationBadAnimate-leave-active {
    animation: bounce-in .5s reverse;
}

.estimationGoodAnimate-enter-active {
    animation: bounce-in .5s;
}

.estimationGoodAnimate-leave-active {
    animation: bounce-in .5s reverse;
}

@keyframes bounce-in {
    0% {
        transform: scale(0);
    }
    50% {
        transform: scale(1.2);
    }
}
</style>