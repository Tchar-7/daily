//这个文件是一个路由配置文件 有新页面就在toutes里面加入一个新的参数，嵌套路由使用children
import Vue from "vue";
import VueRouter from "vue-router";

import Main from '../views/Main'
import Login from "@/views/Login";
import Login2 from "../views/templates/Login"

Vue.use(VueRouter);

const router =  new VueRouter({
    routes : [{
        path:'/main',
        component: Main
    },{
        path:'/login',
        component: Login
    },{
        path:'/login2',
        component: Login2
    }]
})

export  default router;