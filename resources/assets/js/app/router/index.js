import Vue from 'vue';
import VueRouter from 'vue-router'
import ProfileRoutes from './profile'
import Home from '../Pages/Home'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'hash',
  routes: [
    {
      path: '/',
      component: Home
    },
    ...ProfileRoutes
  ]
});

export default router