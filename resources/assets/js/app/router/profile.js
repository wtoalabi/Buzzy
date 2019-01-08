import Store from '../Store';
import Settings from "../Pages/Settings";
import User from "../Pages/UserPage";
export default [
  {
    name: 'Account Settings',
    path: '/account-settings',
    component: Settings,
    beforeEnter(to, from, next){
      checkLoggedIn(next)
    }
  },
  {
    name: 'User Account Page',
    path: '/user/:username',
    component: User,
    beforeEnter(to, from, next) {
      Store.dispatch('retrieveUserDetails', to.params.username)
      next()
    },
  }
]

function checkLoggedIn(next){
  if(_.isEmpty(Store.state.user)){
    return window.location.assign('/')
  }
  return next();
}