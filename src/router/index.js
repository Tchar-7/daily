//这个文件是一个路由配置文件 有新页面就在routes里面加入一个新的参数，嵌套路由使用children
import Vue from "vue";
import VueRouter from "vue-router";


import Login from "@/views/Login";
import Menu from "@/views/Menu";
import Chuxiao from "@/views/Chuxiao";
import Qiandao from "@/views/Qiandao";
import Tianbao from "@/views/Tianbao";
import AdminMenu from "../views/AdminMenu";
import TeacherMenu from "../views/TeacherMenu";
import TeacherChuxiao from "../views/TeacherChuxiao";
import TeacherXiaojia from "../views/TeacherXiaojia";
import QiandaoTongji from "@/views/QiandaoTongji";
import ShowForChaxunNumber from "@/views/ShowForChaxunNumber";
import ChaxunNumber from "@/views/ChaxunNumber";
import Kongbai from "@/views/Kongbai";
import Shenpi from "@/views/Shenpi";
import DialogForShenpi from "@/views/DialogForShenpi";

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
        path: '/AdminMenu',
        component: AdminMenu
    },{
        path: '/TeacherMenu',
        component: TeacherMenu
    },{
        path: '/TeacherChuxiao',
        component: TeacherChuxiao
    },{
        path:'/ChaxunNumber',
        component: ChaxunNumber,
        children:[
            {path: '/ShowForChaxunNumber1/:num',component: ShowForChaxunNumber},
            {path:'/Kongbai1',component:Kongbai}
        ]
    },{
        path:'/QiandaoTongji',
        component: QiandaoTongji
    }, {
        path: '/TeacherXiaojia',
        component: TeacherXiaojia
    },{
        path: '/ShowForChaxunNumber',
        component: ShowForChaxunNumber
    },{
        path: '/Shenpi',
        component: Shenpi
    },{
        path: '/DialogForShenpi',
        component: DialogForShenpi
    }]

})

export  default router;