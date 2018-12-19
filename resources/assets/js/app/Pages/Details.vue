<template>
  <div>
    <div v-if="loaded">
    <span>Item created by:</span>
    {{details.user.full_name}}
    {{details}}
    </div>
    <loading v-else/>
  </div>
</template>

<script>

  export default {
    mounted(){
    },
    component:{},
    data() {
      return {}
    },
    methods: {},
    computed: {
      details(){
        return this.$store.state.wordDetail
      },
      loaded(){
        return !_.isEmpty(this.$store.state.wordDetail);
      }
    }
  }

</script>