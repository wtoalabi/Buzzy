import Store from '../Store'
import Settings from "../Pages/Settings";
export default [
  {
    path: '/account-settings',
    component: Settings,
    beforeEnter(to, from, next){
      checkLoggedIn(next)
    }
  },
]

function checkLoggedIn(next){
  if(_.isEmpty(Store.state.user)){
    return window.location.assign('/')
  }
  return next();
}