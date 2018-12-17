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
  },
  storeTags(state,payload){
    return state.tags = payload
  },
  phoneticSymbols(state, payload){
    return state.optionalFormData.symbols = payload;
  },
  audioFile(state,payload){
    console.log(payload)
    return state.optionalFormData.audioFile = payload;
    
  }
}