import Details from "../Pages/Details";
import Store from "../Store";
import NewWord from "../Pages/NewWord";


export default [
  {
    name: 'Word Detail',
    path: '/details/:word',
    component: Details,
    beforeEnter(to, from, next){
      //Store.dispatch('clearCurrentlyStoredWord')
      Store.dispatch('retrieveDetail',to.params.word)
      next()
    }
  },
  {
    name: 'Create New Word',
    path: '/add-new',
    component: NewWord,
    beforeEnter(to, from, next) {
      Store.dispatch('retrieveTags')
      next()
    }
  }
]