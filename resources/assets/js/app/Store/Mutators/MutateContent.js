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
  audioFileID(state,payload){
    return state.optionalFormData.audioFileID = payload;
  },
  formErrors(state, payload){
    state.formErrors = payload
  },
  clearFormError(state,error){
    state.formErrors[error] = ''
  }
}