export default {
  async initialLoading(context){
    await context.dispatch('getContent')
    await context.dispatch('getUser')
  },

  getContent(context){
    axios.get('api/get-content').then(data=>{
      context.commit('initialContent', data.data)
    }).catch(error=>{
      console.log(new Error(`${error.request.statusText}, Code: ${error.request.status}`))
    })
  },
  getResult(context,searchText){
    return axios.post('api/search',{searchText}).then(data=>{
      return context.commit('searchResult', data.data)
    }).catch(error=>{
      console.log(new Error(`${error.request.statusText}, Code: ${error.request.status}`))
    })
  },
  clearSearchResults(context){
    context.commit('clearResultState')
  },
  retrieveDetail(context, item){
    return axios.get(`api/details/${item}`).then(data=>{
      context.commit('storeDetail',data.data)
    })
  }
}