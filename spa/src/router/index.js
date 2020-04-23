import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import ViewArticle from '../views/ViewArticle.vue'
import AddArticle from '../components/AddArticle.vue'
import dashboard from '../dashboard/index.vue'

Vue.router = new VueRouter();
Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/ViewArticle/:id',
    name: 'ViewArticle',
    component: ViewArticle,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: dashboard,
    meta: {
      auth: true
    },
    children:[
      {
        path: 'addArticle',
        name: 'AddArticle',
        component: AddArticle,
        meta: {
          auth: true
        },
      }
    ]
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
