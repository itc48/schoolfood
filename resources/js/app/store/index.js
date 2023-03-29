import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        api: window.location.origin + '/api/',
        school: null,

        buttonAction: {
            isDisabled: false,
            title: 'Начать1',
            routeName: 'PartGeo',
            progress: 1
        },

        progress: {
            total: 3,
            current: 0
        },

        score: null,
        file: null,
        text: null,
        coordinates: null,

        errorText: null
    },

    mutations: {
        setSchool(state, payload) {
            state.school = payload;
        },
        setButtonAction(state, payload) {
            state.buttonAction = payload;
        },
        setProgress(state, payload) {
            state.progress.current = payload;
        },
        setScore(state, payload) {
            state.score = payload;
        },
        setFile(state, payload) {
            state.file = payload;
        },
        setText(state, payload) {
            state.text = payload;
        },
        setErrorText(state, payload) {
            state.errorText = payload;
        },
        setCoordinates(state, payload) {
            state.coordinates = payload;
        },
    },

    actions: {
        requestSchool: async function ({commit, getters}, payload) {
            axios.get(`${this.state.api}schools/${payload}`,)
                .then(res => {
                    commit('setSchool', res.data);
                })
                .catch(error => {
                    commit('setSchool', undefined);
                });
        },

        sendReview: async function ({commit, getters}, payload) {

            const uuid = payload,
                formData = new FormData(),
                settings = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                };

            formData.append('score', this.state.score);
            formData.append('fingerprint', generate_fingerprint());
            formData.append('latitude', getters.getCoordinates.latitude);
            formData.append('longitude', getters.getCoordinates.longitude);

            if (this.state.file) {
                formData.append('file', this.state.file);
            }

            if (this.state.score === -1 && this.state.text) {
                formData.append('text', this.state.text);
            }

            axios.post(`${this.state.api}schools/${uuid}/review`, formData, settings)
                .then(res => {
                    console.log(res);
                    commit('setScore', null);
                    commit('setText', null);
                    commit('setFile', null);
                })
                .catch(error => {
                    setTimeout(() => {
                        if (error.response) {
                            alert(error.response.data);
                        }
                    }, 700);
                    commit('setScore', null);
                    commit('setText', null);
                    commit('setFile', null);
                });
        },
    },
    getters: {
        getSchool: s => s.school,
        getButtonAction: s => s.buttonAction,
        getProgress: s => s.progress,
        getScore: s => s.score,
        getFile: s => s.file,
        getText: s => s.text,
        getErrorText: s => s.errorText,
        getCoordinates: s => s.coordinates,
    },

});