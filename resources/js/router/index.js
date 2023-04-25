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
        {
            path: '/category/add',
            name: 'add_category',
            component:()=> import('../components/Category/addCategory.vue')
        },
        {
            path: '/category/list',
            name: 'list_category',
            component:()=> import('../components/Category/CategoryList.vue')
        },
        {
            path: '/category/edit/:id',
            name: 'edit_category',
            component:()=> import('../components/Category/CategoryEdit.vue')
        },
        {
            path: '/product/add',
            name: 'add_product',
            component:()=> import('../components/Product/ProductAdd.vue')
        },
        {
            path: '/product/list',
            name: 'list_product',
            component:()=> import('../components/Product/ProductList.vue')
        },
        {
            path: '/product/edit/:id',
            name: 'edit_product',
            component:()=> import('../components/Product/ProductEdit.vue')
        },
        {
            path: '/expense/add',
            name: 'add_expense',
            component:()=> import('../components/Expense/ExpenseCreate.vue')
        },
        {
            path: '/expense/list',
            name: 'list_expense',
            component:()=> import('../components/Expense/ExpenseList.vue')
        },
        {
            path: '/expense/edit/:id',
            name: 'edit_expense',
            component:()=> import('../components/Expense/ExpenseEdit.vue')
        },
        {
            path: '/salary/add',
            name: 'add_salary',
            component:()=> import('../components/Salary/SalaryCreate.vue')
        },
        {
            path: '/salary/list',
            name: 'list_salary',
            component:()=> import('../components/Salary/SalaryList.vue')
        },
        {
            path: '/salary/edit/:id',
            name: 'edit_salary',
            component:()=> import('../components/Salary/SalaryEdit.vue')
        },
        {
            path: '/stock/products',
            name: 'stock_products',
            component:()=> import('../components/StockProduct/StockProduct.vue')
        },
        {
            path: '/stock/product/:id/update',
            name: 'stock_update',
            component:()=> import('../components/StockProduct/StockUpdate.vue')
        },
        {
            path: '/customer/add',
            name: 'add_customer',
            component:()=> import('../components/Customer/CustomerAdd.vue')
        },
        {
            path: '/customer/list',
            name: 'list_customer',
            component:()=> import('../components/Customer/CustomerList.vue')
        },
        {
            path: '/customer/edit/:id',
            name: 'edit_customer',
            component:()=> import('../components/Customer/CustomerEdit.vue')
        },

        {
            path: '/pos/',
            name: 'pos',
            component:()=> import('../components/POS/PointOfSale.vue')
        },


    ]

});

export default router;