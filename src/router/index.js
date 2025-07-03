// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router'

import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import ForgotPassword from '../components/ForgotPassword.vue'
import ResetPassword from '../components/ResetPassword.vue'

const routes = [
  { path: '/', redirect: '/login' },
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/forgot-password', component: ForgotPassword },
  {
    path: '/reset-password/:token',
    name: 'ResetPassword',
    component: ResetPassword,
    props: true,
  },
  {
    path: '/dashboard',
    component: () => import('../components/Dashboard.vue'), // layout with navbar/sidebar
    children: [
      { path: 'profile', component: () => import('../components/Profile.vue') },
      { path: 'employees', component: () => import('../components/EmployeeList.vue') },
      { path: 'employees/create', component: () => import('../components/EmployeeForm.vue') },
      { path: 'employees/:id/edit', component: () => import('../components/EditEmployee.vue') },

      {
        path: 'user-management',
        component: () => import('../components/UserManagement.vue'), // just a wrapper
        children: [
          { path: 'pending', component: () => import('../components/PendingUserList.vue') },
          { path: 'approved', component: () => import('../components/ApprovedUserList.vue') },
        ]
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
