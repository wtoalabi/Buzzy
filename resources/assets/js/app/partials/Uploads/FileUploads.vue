<template>
  <div>
    <div class="file-upload">
      <i :title="`Click to upload new ${type}`" class="fa fa-upload mr-4 file-upload__custom-icon"></i>
      <input type="file" class="file-upload__button" :accept="`${type}/*`">
      <div class="file__info hide"></div>
      <div class="file__info--instructions">
        <p class="file__info--instruction"><em>Max size should be {{maxSize}}kb.</em></p>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props:['type','maxSize','variant'],
    mounted(){
      let fileUploadButton = document.querySelector('.file-upload__button');
      let customUploadIcon = document.querySelector('.file-upload__custom-icon');
      this.fileInfo = document.querySelector('.file__info');
      this.instructions = document.querySelector('.file__info--instructions')
      customUploadIcon.addEventListener('click', () => {
        fileUploadButton.click()
      })
      fileUploadButton.addEventListener('change', (e) => {
        this.$store.commit('clearFormError', this.type)
        let file = e.target.files[0]
        let formData = new FormData();
        formData.append(this.variant, file)
        let size = Math.floor(file.size / 1024)
        this.instructions.classList.add('hide')
        if (size > this.maxSize) {
          this.fileInfo.classList.remove('hide')
          return this.fileInfo.innerHTML = `<div class="file__info--details has-text-danger"><h1>File too big...try something smaller than ${size}kb</h1></div>`
        }
        let fileReader = new FileReader()
        fileReader.readAsDataURL(file)
        fileReader.onload= (e)=>{
          let raw = e.target.result
          this.$store.commit('tempUploadedFile',{raw,file})
          this.$store.commit('tempFormData',formData)
        }
        this.fileInfo.innerHTML = `<div class="file__info--details"><h1><h1>Name: ${file.name}</h1>Size: ${size}kb</h1></div>`
        this.fileInfo.classList.remove('hide')
      })
    },
    data() {
      return {
        fileInfo:'',
        instructions:'',
        file:''
      }
    },
    methods: {},
    computed: {}
  }

</script>