<template>
  <div>
    <FileUploads type="audio" maxSize="50" variant="audio"/>
  </div>
</template>

<script>
  import FileUploads from "./Uploads/FileUploads";
  import audioUploads from '../globals/mixins/audioUpload'
  export default {
    mixins:[audioUploads],
    components:{FileUploads},
    data() {
      return {}
    },
    methods: {},
    computed: {}
  }

</script>