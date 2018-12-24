import Details from "../Pages/Details";
import Store from "../Store";
import NewWord from "../Pages/NewWord";
import TagsPage from "../Pages/TagsPage";


export default [
  {
    name: 'Word Detail',
    path: '/details/:word',
    component: Details,
    beforeEnter(to, from, next){
      Store.dispatch('retrieveDetail',to.params.word)
      next()
    }
  }, {
    name: 'Create New Word',
    path: '/add-new',
    component: NewWord,
    beforeEnter(to, from, next) {
      Store.dispatch('retrieveTags')
      next()
    }
  },{
    name: 'Tag Words List',
    path: '/tags/:tag',
    component: TagsPage,
    beforeEnter(to, from, next){
      Store.dispatch('getTagWords',to.params.tag)
      next()
    },
  }
]