import { createRouter, createWebHistory } from 'vue-router'

// Import your pages
import Welcome from './Pages/Welcome.vue'
import Login from './Pages/Login.vue'
import Register from './Pages/Register.vue'
import Explore from './Pages/Explore.vue'
import AddCar from './Pages/AddCar.vue'
import Profile from './Pages/Profile.vue'
import ViewCar from './Pages/ViewCar.vue'

const routes = [
  { path: '/', name: 'home', component: Welcome },
  { path: '/register', name: 'register', component: Register },
  { path: '/login', name: 'login', component: Login },
  { path: '/explore', name: 'explore', component: Explore },
  { path: '/cars/new', name: 'add-car', component: AddCar },
  { path: '/profile', name: 'profile', component: Profile },
  { path: '/cars/:car_id', name: 'view-car', component: ViewCar },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
