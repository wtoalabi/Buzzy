import Router from "../../router";
import Store from '../../Store'
export default{
  serverError(state,payload){
    Store.commit('loaded')
    let status = payload.response.status
    let statusCodes = {
      '404': "This content cant be found. Are you sure it exists?",
      '419': "You will need to relogin again.",
      '401': "Session expired. You will be redirected to login again.",
      '422': "The request cannot be processed. Please check the form and try again.",
      '403': "You are not authorized for this action.",
      '405': "You are going too fast! <br />Try again in the next few seconds...",
      '500': "Server Error. Please try again later."
    }
    state.announcement.message = {
      type: 'error',
      text: statusCodes[status] || "Server Error. Please try again shortly!",
      duration: '5000',
    }
    if(status == '401' || status =='419' || status == '403'){
      setTimeout(()=>{
        return Router.push('/')
      },state.announcement.message.duration)
    }
    if(status == '404'){
      setTimeout(()=>{
        return Router.push('/')
      },state.announcement.message.duration)
    }
  },
}