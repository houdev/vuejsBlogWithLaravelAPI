import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'

const config = {
    auth: bearer,
    http: axios,
    router: router,
    tokenDefaultName: 'laravel-jwt-auth',
    tokenStore: ['localStorage'],

    // API endpoints used in Vue Auth.
    registerData: {
        url: 'http://127.0.0.1:8000/api/register',
        method: 'POST',
        redirect: '/login'
    },
    loginData: {
        url: 'http://127.0.0.1:8000/api/login',
        method: 'POST',
        redirect: '/dashboard',
        fetchUser: true
    },
    logoutData: {
        url: 'http://127.0.0.1:8000/api/logout',
        method: 'GET',
        redirect: '/',
        makeRequest: true
    },
    fetchData: {
        url: 'http://127.0.0.1:8000/api/user',
        method: 'POST',
        enabled: true
    },
    refreshData: {
        url: 'http://127.0.0.1:8000/api/refresh',
        method: 'GET',
        enabled: true,
        interval: 30
    }
}

export default config