<template>
    <div class="textareaWrapper">
        <textarea class="textarea" v-model="textZoneDescription" @change="setText()"></textarea>
    </div>
</template>

<script>

    export default {
        name: "TextZone",
        data() {
            return {
                textZoneDescription: null,
                textBus: null
            }
        },
        methods: {
            setText() {
                this.$store.commit('setText', this.textZoneDescription);
            }
        }
    }
</script>

<style scoped>
    /*текстовая зона на шорткарточке*/
    .pretexttextzone {
        margin-bottom: 1.5rem;
        font-size: .8rem;
        text-align: center;
    }

    .textarea {
        box-sizing: border-box;
        border: none;
        border-radius: .57rem;
        background-color: #F0F0F0;
        width: 15rem;
        height: 10rem;
        padding: .5rem;
        resize: none;
    }
</style>