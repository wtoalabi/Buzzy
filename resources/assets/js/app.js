import lodash from './app/globals/lodash'
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');
window._ = lodash
require('./app/globals/home')
require('./bootstrap')
require('./utils')
require('./app/index')
require('./app/globals/menu')
require('./components/index')
import states from './app/globals/states'
const router = require('./app/router/').default;
import store from './app/Store'
Vue.config.productionTip = false
Vue.mixin({
  data: states
})
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    store,
    router,
    el: '#buzz'
});
