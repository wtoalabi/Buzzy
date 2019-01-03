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
      beforeEnter(to, from, next) {
        //window.location.search.endsWith('logged-in') ? Store.commit('message','Logged In!') : ''
        Store.dispatch('getContent')
        next()
      }
    },
    ...ProfileRoutes,
    ...Items,
  ]
});
router.beforeEach((to, from, next) => {
  let urlBeforeLogin = window.localStorage.getItem('urlBeforeLogin');
  if (urlBeforeLogin) {
    window.localStorage.clear()
    this.default.push('/' + urlBeforeLogin.substr(2))
    Store.commit('message', 'Logged In!')
  }
  next()
})

export default router