export default {
  mounted(){

  },
  methods:{
    saveFile(){
      this.sending = true
      let fileInfo = document.querySelector('.file__info');
      fileInfo.classList.add('hide')
      return axios.post('api/save-avatar',this.uploads.formData).then(response=>{
        this.form.avatar = this.tempFile.raw
        this.$store.commit('updateUserAvatar', response.data.data)
        this.sending = false
      }).catch(error=>{
        this.$store.commit('formErrors', error.response.data.errors);
      })
    },
    removeAvatar(e){
      e.preventDefault()
      this.fileInfo = document.querySelector('.file__info');
      return axios.delete('api/delete-avatar').then(response=>{
        this.fileInfo.innerHTML = ''
        this.$store.commit('updateUserAvatar', response.data.data)
        this.$store.commit('clearTempUploads', response.data.data)
        this.form.avatar = this.user.avatar
      }).catch(error=>{

      })
    }
  },
  computed:{
    uploads(){
      return this.$store.state.uploads
    },
    tempFile(){
      return this.uploads.tempFile
    },
    file(){
      return this.tempFile.file
    }
  },
  watch:{
    tempFile(){
      if(this.file){
        this.saveFile()
      }
    }
  },
}