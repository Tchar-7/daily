import Vue from 'vue'
import App from './App.vue'
import router from '@/router/index'
import ElementUI from 'element-ui'
import axios from "axios";
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

import 'element-ui/lib/theme-chalk/index.css';


Vue.config.productionTip = false
//显示声明使用
Vue.use(ElementUI);
Vue.use(router);

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
