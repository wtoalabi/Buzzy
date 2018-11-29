export default {
  getUser(context) {
    axios.get('api/get-logged-in-user').then(data=>{
      context.commit('loggedInUser', data.data)
    }).catch(error=>{
      console.log(new Error(`${error.request.statusText}, Code: ${error.request.status}`))
    })
  }
}