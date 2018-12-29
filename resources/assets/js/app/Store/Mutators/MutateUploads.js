export default {
  tempUploadedFile(state, payload){
    state.uploads.tempFile = ''
    return state.uploads.tempFile = payload
  },
  tempFormData(state,payload){
    state.uploads.formData = ''
    return state.uploads.formData = payload
  },
  clearTempUploads(state){
    state.uploads = {audioID:'',avatarID:'',formData:'',tempFile:''}
  },
  audioFileID(state,payload){
    return state.uploads.audioID = payload;
  },
  removeAudio(state){
    return state.uploads.audioID = ''
  },
  updateUserAvatar(state,payload){
    return state.userDetails.user = payload
  },
}