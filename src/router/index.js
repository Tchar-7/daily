//这个文件是一个路由配置文件 有新页面就在toutes里面加入一个新的参数，嵌套路由使用children
import Vue from "vue";
import VueRouter from "vue-router";


import Login from "@/views/Login";
import Menu from "@/views/Menu";
import Chuxiao from "@/views/Chuxiao";
import Qiandao from "@/views/Qiandao";
import Tianbao from "@/views/Tianbao";
import Admin_menu from "@/views/Admin_menu";

// 解决ElementUI导航栏中的vue-router在3.0版本以上重复点菜单报错问题

Vue.use(VueRouter);

const router =  new VueRouter({
    routes : [{
        path:'/',
        component: Login
    },{
        path:'/Menu',
        component: Menu
    },{
        path: '/Chuxiao',
        component: Chuxiao
    },{
        path: '/Qiandao',
        component: Qiandao
    },{
        path: '/Tianbao',
        component: Tianbao
    },{
        path: '/Admin_menu',
        component: Admin_menu
    }]
})

export  default router;