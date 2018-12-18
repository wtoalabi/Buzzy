<template>
  <div class="audio-upload">
    <i class="fa fa-upload mr-4 audio-upload__custom-icon"></i>
    <input type="file" class="audio-upload__button" accept="audio/*">
    <div class="file__info hide"></div>
    <p class="file__info--instruction"><em>Max size should be 150kb.</em></p>
  </div>
</template>

<script>

  export default {
    mounted(){
      this.parentDIV = document.querySelector('.audio-column')
      this.cancelIconEl = document.createElement('div')
      let audioUploadButton = document.querySelector('.audio-upload__button');
      let customUploadIcon = document.querySelector('.audio-upload__custom-icon');
      this.fileInfo = document.querySelector('.file__info');
      this.instruction = document.querySelector('.file__info--instruction')
      customUploadIcon.addEventListener('click',()=>{
        audioUploadButton.click()
      })
      audioUploadButton.addEventListener('change',(e)=>{
        this.$store.commit('clearFormError','audio')
        let file = e.target.files[0]
        let formData = new FormData();
        formData.append('audio', file)
        let size = Math.floor(file.size/1024)
        this.fileInfo.classList.remove('hide')
        if(size > 10050){
          return this.fileInfo.innerHTML = `<div class="file__info--details"><h1>File too big...try something smaller than ${size}kb</h1></div>`
        }
        this.fileInfo.innerHTML = `<div class="file__info--details"><h1><h1>Name: ${file.name}</h1>Size: ${size}kb</h1></div>`
        this.instruction.classList.add('hide')
        this.fileInfo.classList.remove('hide')
        /*let reader = new FileReader()
        reader.readAsDataURL(file)
        reader.onload= (e)=>{
          let audio = e.target.result
        }*/
        return axios.post(`api/save-audio/${file.name}`,formData).then(response=>{
          this.$store.commit('audioFileID', response.data)
          this.addCancelIcon()
        }).catch(error=>{
          this.$store.commit('formErrors', error.response.data.errors);
        })
      })
    },
    data() {
      return {
        parentDIV: '',
        cancelIconEl: '',
        fileInfo:'',
        instruction:''
      }
    },
    methods: {
      addCancelIcon(){
        this.cancelIconEl.innerHTML = `<i title="Cancel Audio File" class="fa fa-close file__info--close"></i>`
        this.parentDIV.appendChild(this.cancelIconEl)
        this.cancelIconEl.addEventListener('click',()=>{
          return axios.delete(`api/delete-audio/${this.audioFileID}`).then(response=>{
            this.fileInfo.innerHTML = ''
            this.instruction.classList.remove('hide')
            this.cancelIconEl.innerHTML = ''
          })
        })
      }
    },
    computed: {
      audioFileID() {
        return this.$store.state.optionalFormData.audioFileID
      }
    }
  }

</script>

<style scoped>

</style>