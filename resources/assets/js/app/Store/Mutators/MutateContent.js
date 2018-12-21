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
    return state.wordDetail = payload.data
  },
  clearErrors(state){
    return state.error = ''
  },
  clearCurrentlyStoredWord(state){
    return state.wordDetail = []
  },
  deleteCurrentlyStoredItem(state){
    return state.wordDetail = []
  },
  error(state,payload){
    return state.error = payload
  },
  storeTags(state,payload){
    return state.tags = payload
  },
  selectedTags(state, payload){
    return state.formData.tags = payload
  },
  suggestedTags(state, payload){
    return state.formData.suggestedTags = payload
  },
  phoneticSymbols(state, payload){
    return state.formData.symbols = payload;
  },
  audioFileID(state,payload){
    return state.formData.audioFileID = payload;
  },
  removeAudio(state){
    return state.formData.audioFileID = ''
  },
  formErrors(state, payload){
    state.formErrors = payload
  },
  clearFormError(state,error){
    state.formErrors[error] = ''
  }
}