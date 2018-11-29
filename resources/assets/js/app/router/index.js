import Vue from 'vue';
import VueRouter from 'vue-router'
import Settings from '../Pages/Settings'
import Home from '../Pages/Home'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'hash',
  routes: [
    {
      path: '/settings',
      component: Settings
    },
    {
      path: '/',
      component: Home
    }
  ]
});

export default router