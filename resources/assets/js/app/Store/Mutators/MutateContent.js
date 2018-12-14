export default {
  initialContent(state, payload){
    return state.content = payload
  },
  searchResult(state,payload){
    return state.searchResults = payload.data
  },
  clearResultState(state){
    return state.searchResults = []
  },
  storeDetail(state,payload){
    return state.itemDetail = payload.data
  },
  clearErrors(state){
    return state.error = ''
  },
  deleteCurrentlyStoredItem(state){
    return state.itemDetail = []
  },
  error(state,payload){
    return state.error = payload
  }
}