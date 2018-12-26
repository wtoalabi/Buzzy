export default {
  loggedInUser(state, payload) {
    return state.loggedInUser = payload
  },
  clearUserData(state) {
    state.user = {}
    return window.location.assign('/')
  },
  userDetails(state, payload) {
    return state.userDetails = payload
  },
  clearUserDetails(state) {
    return state.userDetails = []
  }
}