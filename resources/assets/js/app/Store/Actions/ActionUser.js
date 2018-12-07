export default {
  getUser(context) {
    axios.get('api/get-logged-in-user').then(data=>{
      context.commit('loggedInUser', data.data)
    }).catch(error=>{
      new Error(`${error.request.statusText}, Code: ${error.request.status}`)
    })
  },
  logout(context){
    axios.post('api/logout').then(data=>{
      if(_.isEmpty(data.data)){
        context.commit('clearUserData')
      }
    }).catch(error=>{

    })
  },
  login(context, provider){
    const origin = window.location.origin;
    const hash = window.location.hash;
    let url = hash.length > 2 ? `${origin}/%23${hash.substr(1,hash.length)}` : window.location.href
    window.location.assign(`auth/${provider}?provider=${url}`)
  }
}