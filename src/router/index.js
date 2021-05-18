import Vue from "vue";
import VueRouter from "vue-router";

import Main from '../views/Main'
import Login from "@/views/Login";

Vue.use(VueRouter);

const router =  new VueRouter({
    routes : [{
        path:'/main',
        component: Main
    },{
        path:'/login',
        component: Login
    }]
})

export  default router;