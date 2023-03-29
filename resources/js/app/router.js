import Vue from 'vue';
import VueRouter from 'vue-router';
import Review from './views/Review';
import Index from './views/Index';
import PartOne from './views/PartOne';
import PartTwo from "./views/PartTwo";
import PartThree from "./views/PartThree";
import PartEnd from "./views/PartEnd";
import NotFound404 from "./views/NotFound404";
import PartGeo from "./views/PartGeo";
import store from './store';
import geolocation from "./middleware/geolocation";

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/review/:school_uuid',
            component: Review,
            children: [
                {
                    path: '/',
                    component: Index,
                    name: 'ReviewIndex'
                },
                {
                    path: 'part_geo',
                    component: PartGeo,
                    name: 'PartGeo',
                },
                {
                    path: 'part_one',
                    component: PartOne,
                    name: 'PartOne',
                    meta: {
                        middleware: [
                            geolocation
                        ]
                    },
                },
                {
                    path: 'part_two',
                    component: PartTwo,
                    name: 'PartTwo',
                    meta: {
                        middleware: [
                            geolocation
                        ]
                    },
                },
                {
                    path: 'part_three',
                    component: PartThree,
                    name: 'PartThree',
                    meta: {
                        middleware: [
                            geolocation
                        ]
                    },
                },
                {
                    path: 'end',
                    component: PartEnd,
                    name: 'End',
                    meta: {
                        middleware: [
                            geolocation
                        ]
                    },
                }
            ]
        },
        {
            path: '/*',
            name: 'NotFound404',
            component: NotFound404
        },
    ]
})

router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware
    const context = {
        to,
        from,
        next,
        store
    }
    return middleware[0]({
        ...context
    })
})

export default router