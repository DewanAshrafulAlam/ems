// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router'
import Login from '../components/Login.vue'
import Register from '../components/Register.vue'
import ForgotPassword from '../components/ForgotPassword.vue'
import Dashboard from '../components/Dashboard.vue'
import Profile from '../components/Profile.vue'
import EmployeeForm from '../components/EmployeeForm.vue'
import EmployeeList from '../components/EmployeeList.vue'


const routes = [
  { path: '/', redirect: '/login' },
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/forgot-password', component: ForgotPassword },
  {
    path: '/dashboard',
    component: Dashboard,
    children: [
      { path: 'profile', component: Profile },
      { path: 'employees/create', component: EmployeeForm },
      { path: 'employees', component: EmployeeList },
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router;
