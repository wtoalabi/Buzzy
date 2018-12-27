export default {
  loggedInUser(state, payload) {
    return state.loggedInUser = payload
  },
  clearUserData(state) {
    state.user = {}
    return window.location.assign('/')
  },
  userDetails(state, payload) {
    state.userDetails = {...payload,bookmarks:[]}
  },
  clearUserDetails(state) {
    state.userDetails = {words:[],bookmarks:[],user:{}}
  },
  userBookmarks(state, payload){
    if(payload === 'None'){
      return state.userDetails.bookmarks = payload
    }
    return state.userDetails.bookmarks = payload.data
  }
}