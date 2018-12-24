import Vue from 'vue';
import VueRouter from 'vue-router'
import ProfileRoutes from './profile'
import Items from './items'
import Home from '../Pages/Home'
import Lorem from "../partials/Lorem";
import Store from "../Store";

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'hash',
  routes: [
    {
      path: '/',
      component: Home,
      beforeEnter(to, from ,next){
        Store.dispatch('getContent')
        next()
      }
    },
    ...ProfileRoutes,
    ...Items,
    {
      path: '/lorem',
      component: Lorem
    }
  ]
});

export default router