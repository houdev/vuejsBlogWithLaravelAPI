import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import ViewArticle from '../views/ViewArticle.vue'
import AddArticle from '../dashboard/article/AddArticle.vue'
import dashboardIndex from '../dashboard/index.vue'
import dashboard from '../dashboard/view/dashboard.vue'
import MyArticles from '../dashboard/article/MyArticles.vue'
import Articles from '../dashboard/article/index.vue'
import Members from "../dashboard/members/index";
import myProfile from "../dashboard/members/myProfile.vue";
import Page403 from "../HTTP Status/Page403.vue";
import Login from "../components/Login.vue";

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Home',
    component:
    Home,
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
    name: 'dashboardIndex',
    component: dashboardIndex,
    meta: {
      auth: true
    },
    children:[
      {
        path: 'dashboard',
        name: 'dashboard',
        component: dashboard,
        meta: {
          auth: true
        }
      },
      {
        path: 'articles',
        name: 'articles',
        component: Articles,
        meta: {
          auth: true
        }
      },
      {
        path: 'addArticle',
        name: 'AddArticle',
        component: AddArticle,
        meta: {
          auth: true
        }
      },
      {
        path: 'myArticles',
        name: 'MyArticles',
        component: MyArticles,
        meta: {
          auth: true
        },
      },
      {
        path: 'members',
        name: 'Members',
        component: Members,
        meta: {
          auth: true
        },
      },
      {
        path: 'myProfile',
        name: 'myProfile',
        component: myProfile,
        meta: {
          auth: true
        },
      }
    ]
  },
  {
    path: '/403',
    name: 'Page403',
    component: Page403,
    meta: {
        auth: undefined
    }
  },
  {
  path: '/Login',
  name: 'Login',
  component: Login,
  meta: {
      auth: false
  }
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
