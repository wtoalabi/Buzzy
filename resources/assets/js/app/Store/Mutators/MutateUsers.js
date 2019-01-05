import Store from '../../Store'
export default {
  loggedInUser(state, payload) {
    payload ? state.loggedInUser = payload : null
  },
  clearLoggedInUser(state){
    return state.loggedInUser = {}
  },
  clearUserData(state) {
    state.user = {}
    return window.location.assign('/')
  },
  userDetails(state, payload) {
    state.userDetails = {...payload,bookmarks:[]}
  },
  clearUserDetails(state) {
    state.userDetails = {words:[],bookmarks:[],user:{},social_profiles:{}}
  },
  userBookmarks(state, payload){
    if(payload === 'None'){
      return state.userDetails.bookmarks = payload
    }
    return state.userDetails.bookmarks = payload.data
  },
  updateUserAccount(state,payload){
    Store.commit('clearFormError','username')
    Store.commit('loggedInUser', payload)
    state.userDetails.user = payload
    window.history.pushState('','',`/#/user/${payload.username}`)
    Store.commit('message',{type:'success', text:'Profile Updated'})
  },
  userSocialProfile(state,payload){
    state.userDetails.social_profiles = payload
  }
}