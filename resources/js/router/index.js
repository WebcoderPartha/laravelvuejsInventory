import {createRouter, createWebHistory} from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'login',
            component:()=> import('../components/Login.vue')
        },
        {
            path: '/register',
            name: 'register',
            component:()=> import('../components/Register.vue')
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component:()=> import('../components/Dashboard.vue')
        },
        {
            path: '/logout',
            name: 'logout',
            component:()=> import('../components/Logout.vue')
        }

    ]

});

export default router;