import {createRouter, createWebHistory} from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component:()=> import('../components/Login.vue')
        },
        {
            path: '/contact',
            name: 'contact',
            component:()=> import('../components/ExampleComponent.vue')
        }
    ]

});

export default router;