import Details from "../Pages/Details";
import Store from "../Store";
import Router from "../router";
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
      if(!_.isEmpty(Store.state.loggedInUser)){
        Store.dispatch('retrieveTags')
        next()
      }
      Store.commit('message',{type:'error', text:'Not Authorized to view this page...'})
      Router.push('/')
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