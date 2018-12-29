export default {
  methods: {
    addCancelIcon(){
      this.fileInfo = document.querySelector('.file__info');
      this.instructions = document.querySelector('.file__info--instructions')
      this.parentDIV = document.querySelector('.audio-column')
      this.cancelIconEl = document.createElement('div')
      this.cancelIconEl.innerHTML = `<i title="Cancel Audio File" class="fa fa-close file__info--close"></i>`
      this.parentDIV.appendChild(this.cancelIconEl)
      this.cancelIconEl.addEventListener('click', () => {
        return axios.delete(`api/delete-audio/${this.uploads.audioID}`).then(response => {
          this.fileInfo.innerHTML = ''
          this.instructions.classList.remove('hide')
          this.cancelIconEl.innerHTML = ''
          this.$store.commit('clearTempUploads')
        })
      })
    },
    saveFile(){
      return axios.post(`api/save-audio/${this.file.name}`,this.uploads.formData).then(response=>{
        this.$store.commit('audioFileID', response.data)
        this.addCancelIcon()
      }).catch(error=>{
        this.$store.commit('formErrors', error.response.data.errors);
      })
    }
  },
  watch:{
    tempFile(){
      this.saveFile()
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
  }
}