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
  }

}