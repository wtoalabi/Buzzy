import Details from "../Pages/Details";
import Store from "../Store";
import NewItem from "../Pages/NewWord";


export default [
  {
    name: 'Item Detail',
    path: '/details/:item',
    component: Details,
    beforeEnter(to, from, next){
      Store.dispatch('retrieveDetail',to.params.item)
      next()
    }
  },
  {
    name: 'Create New Item',
    path: '/add-new',
    component: NewItem,
  }
]