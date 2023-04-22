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
        },
        {
            path: '/employee/add',
            name: 'add_employee',
            component:()=> import('../components/Employee/create.vue')
        },
        {
            path: '/employee/list',
            name: 'list_employee',
            component:()=> import('../components/Employee/EmployeeList.vue')
        },
        {
            path: '/employee/edit/:id',
            name: 'edit_employee',
            component:()=> import('../components/Employee/Edit.vue')
        },
        {
            path: '/supplier/add',
            name: 'add_supplier',
            component:()=> import('../components/Supplier/AddSupplier.vue')
        },
        {
            path: '/supplier/list',
            name: 'list_supplier',
            component:()=> import('../components/Supplier/SupplierList.vue')
        },
        {
            path: '/supplier/edit/:id',
            name: 'edit_supplier',
            component:()=> import('../components/Supplier/SupplierEdit.vue')
        },


    ]

});

export default router;