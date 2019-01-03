export default {
  loggedInUser: {},
  content: {},
  loaded: false,
  searchResults: [],
  visible: 'hide',
  wordDetail:[],
  announcement:{
    message:{
      type: 'success',
      text: '',
      duration: 5000,
    },
  },
  tags: [],
  tagWords:[],
  formData:{symbols:'',tags:[],suggestedTags:[]},
  formErrors: {},
  userDetails:{bookmarks:[],user:[],words:[],social_profiles:{}},
  uploads:{tempFile:'',formData:'',audioID:'',avatarID:''}
}