import Vue from 'vue'
import Vuex from 'vuex'
import App from './App.vue'
import VueRouter from 'vue-router'
import store from './store'
import router from './router'

export const eventBus = new Vue();

Vue.use(VueRouter)
Vue.use(Vuex)
Vue.config.productionTip = false

new Vue({
    store,
    router,
    render: h => h(App),
}).$mount('#app')
