import {createRouter, createWebHistory} from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component:()=> import('../js/components/Dashboard.vue')
        },
        {
            path: '/contact',
            name: 'contact',
            component:()=> import('../js/components/ExampleComponent.vue')
        }
    ]

});

export default router;