import Store from '../Store'
import Settings from "../Pages/Settings";
import User from "../Pages/UserPage";
export default [
  {
    path: '/account-settings',
    component: Settings,
    beforeEnter(to, from, next){
      checkLoggedIn(next)
    }
  },
  {
    name: 'UserPage',
    path: '/user/:username',
    component: User,
    beforeEnter(to, from, next) {
      Store.dispatch('retrieveUserDetails', to.params.username)
      next()
    }
  }
]

function checkLoggedIn(next){
  if(_.isEmpty(Store.state.user)){
    return window.location.assign('/')
  }
  return next();
}