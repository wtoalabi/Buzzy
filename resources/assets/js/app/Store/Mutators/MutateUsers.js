export default {
  loggedInUser(state, payload) {
    payload ? state.loggedInUser = payload : null
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
    state.userDetails.user = payload
  },
  userSocialProfile(state,payload){
    state.userDetails.social_profiles = payload
  }
}