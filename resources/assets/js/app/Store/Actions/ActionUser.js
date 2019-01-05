export default {
  getUser(context) {
    context.commit('fetching')
    axios.get('api/get-logged-in-user').then(data=>{
      context.commit('loaded')
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
      window.localStorage.setItem('urlBeforeLogin', hash)
      window.location.assign(`auth/${provider}`)
  },
  retrieveUserDetails(context,username){
    context.commit('fetching')
    return axios.get(`api/get-user-details/${username}`).then(data=>{
      context.commit('loaded')
      context.commit('userDetails',data.data)
    }).catch(error=>{
      console.dir(error)
      return context.commit('serverError',error)
    })
  },
  getUserBookmarks(context){
    return axios.get('api/user-bookmarks').then(data=>{
      return context.commit('userBookmarks',data.data)
    }).catch(error=>{
    
    })
  },
  checkIfStillLoggedIn(context){
    return axios.post('api/check-if-logged-in').then(data=>{
      data.data === false ? context.commit('clearLoggedInUser') : ''
    }).catch(error=>{
    
    })
  }
}