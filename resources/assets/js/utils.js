import Store from "./app/Store/";
export default function utils(){
  return {
    isLoggedIn: !_.isEmpty(Store.state.loggedInUser)
  }
}