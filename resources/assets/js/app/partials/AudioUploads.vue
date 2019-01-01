<template>
  <div>
    <loading v-if="sending"/>
    <FileUploads type="audio" maxSize="100" variant="audio"/>
  </div>
</template>

<script>
  import FileUploads from "./Uploads/FileUploads";
  import audioUploads from '../globals/mixins/audioUpload'
  export default {
    mixins:[audioUploads],
    components:{FileUploads},
    data() {
      return {
        sending: false
      }
    },
    methods: {},
    computed: {}
  }

</script>