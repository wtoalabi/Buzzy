<template>
  <div>
    <span>Item created by:</span>
    {{details.user.full_name}}
    {{details}}
  </div>
</template>

<script>

  export default {
    mounted(){
      console.log(this.$store.state.itemDetail)
    },
    component:{},
    data() {
      return {}
    },
    methods: {},
    computed: {
      details(){
        return this.$store.state.itemDetail
      }
    }
  }

</script>