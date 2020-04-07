import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import ViewArticle from '../views/ViewArticle.vue'
import AddArticle from '../components/AddArticle.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/ViewArticle/:index',
    name: 'ViewArticle',
    component: ViewArticle
  },
  {
    path: '/AddArticle',
    name: 'AddArticle',
    component: AddArticle
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
