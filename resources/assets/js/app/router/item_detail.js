import Details from "../Pages/Details";
import Store from "../Store";


export default [
  {
    name: 'Item Detail',
    path: '/details/:item',
    component: Details,
    beforeEnter(to, from, next){
      Store.dispatch('retrieveDetail',to.params.item)
      next()
    }
  }
]