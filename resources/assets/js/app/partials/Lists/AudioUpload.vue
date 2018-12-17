<template>
  <div class="audio-upload">
    <i class="fa fa-upload mr-4 audio-upload__custom-icon"></i>
    <input type="file" class="audio-upload__button" accept="audio/mp3">
    <div class="file__info hide"></div>
    <p><em>Max size should be 15kb. MP3 only</em></p>
  </div>
</template>

<script>

  export default {
    mounted(){
      let audioUploadButton = document.querySelector('.audio-upload__button');
      let customUploadIcon = document.querySelector('.audio-upload__custom-icon');
      let fileInfo = document.querySelector('.file__info');
      console.log(audioUploadButton)
      customUploadIcon.addEventListener('click',()=>{
        audioUploadButton.click()
      })
      audioUploadButton.addEventListener('change',(e)=>{
        let file = e.target.files[0]
        let size = Math.floor(file.size/1024)
        fileInfo.classList.remove('hide')
        if(size > 15){
          return fileInfo.innerHTML = `<div class="file__info--details"><h1>File too big...try something smaller than ${size}kb</h1></div>`
        }
        fileInfo.innerHTML = `<div class="file__info--details"><h1>Size: ${size}kb</h1><h1>Name: ${file.name}</h1></div>`
        fileInfo.classList.remove('hide')
        let reader = new FileReader()
        reader.readAsDataURL(file)
        let formData = new FormData();
        formData.append('audio', file)
        this.$store.commit('audioFile', formData)
        reader.onload= (e)=>{
          let audio = e.target.result
        }
      })
    },
    data() {
      return {}
    },
    methods: {},
    computed: {}
  }

</script>

<style scoped>

</style>