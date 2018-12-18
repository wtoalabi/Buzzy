export default {
  async initialLoading(context){
    await context.dispatch('getContent')
    await context.dispatch('getUser')
  },

  getContent(context){
    context.commit('clearErrors')
    axios.get('api/get-content').then(data=>{
      context.commit('initialContent', data.data)
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
    context.commit('deleteCurrentlyStoredItem')
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
    axios.post('api/save-new-word', form).then(data=>{

    }).catch(error=>{
      context.commit('formErrors', error.response.data.errors);
    })
  }
}