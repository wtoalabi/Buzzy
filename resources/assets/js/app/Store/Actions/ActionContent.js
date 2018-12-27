import router from "../../router";

export default {
  async initialLoading(context){
    await context.dispatch('getContent')
    await context.dispatch('getUser')
  },

  getContent(context){
    context.commit('clearErrors')
    axios.get('api/get-content').then(data=>{
      context.commit('initialContent', data.data)
      context.commit('loaded')
    }).catch(error=>{
      context.commit('error', error)
      console.log(new Error(`${error.request.statusText}, Code: ${error.request.status}`))
    })
  },
  getResult(context,searchText){
    context.commit('clearErrors')
    return axios.post('api/search',{searchText}).then(data=>{
      return context.commit('searchResult', data.data)
    }).catch(error=>{
      context.commit('error', error)
      console.log(new Error(`${error.request.statusText}, Code: ${error.request.status}`))
    })
  },
  clearSearchResults(context){
    context.commit('clearResultState')
  },
  retrieveDetail(context, item){
    context.commit('clearErrors')
    context.commit('clearCurrentlyStoredWord')
    return axios.get(`api/details/${item}`).then(data=>{
      context.commit('storeDetail',data.data)
    }).catch(error=>{
      context.commit('error', error)
    })
  },
  retrieveTags(context){
    return axios.get('api/get-tags').then(data=>{
      context.commit('storeTags',data.data.data)
    }).catch(error=>{
    console.log(error)
    })
  },
  saveWord(context, form){
    axios.post('api/save-new-word', form).then(word=>{
      context.dispatch('getContent')
      router.push({ path: `/details/${word.data}` })
    }).catch(error=>{
      context.commit('formErrors', error.response.data.errors);
    })
  },
  saveDescription(context, payload){
    axios.post('api/save-new-description', payload.form).then(()=>{
      context.dispatch('retrieveDetail',payload.slug)
    }).catch(error=>{
      context.commit('formErrors', error.response.data.errors);
    })
  },
  updateDescriptionLikes(context,payload){
    return axios.post(`api/likes/${payload}`).then(response=>{
      context.commit('updateDescriptions',response.data.data)
    })
  },
  getTagWords(context,tag){
    return axios.get(`api/words-tag/${tag}`).then(data=>{
      context.commit('tagWords',data.data)
    }).catch(error=>{
    
    })
  },
  bookmarkThis(context, payload){
    return axios.post(`api/bookmark-word/${payload}`).then(data=>{
      context.commit('storeDetail',data.data)
    }).catch(error=>{

    })
  },
}