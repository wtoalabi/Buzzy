export default {
  getUser(context) {
    axios.get('api/get-logged-in-user').then(data=>{
      context.commit('loggedInUser', data.data.data)
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
    const hash = window.location.hash;
    window.localStorage.setItem('urlBeforeLogin', hash.substr(2))
    window.location.assign(`auth/${provider}`)
  },
  retrieveUserDetails(context,username){
    return axios.get(`api/get-user-details/${username}`).then(data=>{
      context.commit('userDetails',data.data)
    }).catch(error=>{
      context.commit('error', error)
      return console.dir(new Error(error.response.data))
    })
  },
  getUserBookmarks(context){
    return axios.get('api/user-bookmarks').then(data=>{
      return context.commit('userBookmarks',data.data)
    }).catch(error=>{
    
    })
  }
}