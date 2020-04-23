import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify';
import router from './router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueAuth from '@websanova/vue-auth'
import auth from './auth'

Vue.config.productionTip = false
Vue.router = router

Vue.use(VueAxios, axios)
Vue.use(VueAuth, auth)

new Vue({
  vuetify,
  router,
  render: h => h(App)
}).$mount('#app')
