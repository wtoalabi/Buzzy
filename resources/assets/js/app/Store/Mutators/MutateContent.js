export default {
  message(state,message){
    state.announcement.message.type = message.type || 'success'
    state.announcement.message.text = message.text
    state.announcement.message.duration = 5000
  },
  initialContent(state, payload){
    return state.content = payload
  },
  loaded(state){
    state.loaded = true
  },
  fetching(state){
    state.loaded = false
  },
  clearHomeList(state){
    return state.content = {}
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
  formErrors(state, payload){
    state.formErrors = payload
  },
  clearFormError(state,error){
    state.formErrors[error] = ''
  },
  updateDescriptions(state, payload){
    let newDescriptions = state.wordDetail.descriptions.map((description)=>{
      if(description.id === payload.id){
        return description = payload
      }else{
        return description
      }
    })
    return state.wordDetail.descriptions = newDescriptions
  },
  tagWords(state,payload){
    state.tagWords = payload.data
  },
  clearTagWords(state){
    state.tagWords = [];
  },
  storeWordsIndex(state, payload){
    return state.wordsList = payload
  }

}