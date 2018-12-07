export default {
  loggedInUser(state, payload){
    return state.user = payload
  },
  clearUserData(state){
    state.user = {}
    return window.location.assign('/')
  }
}