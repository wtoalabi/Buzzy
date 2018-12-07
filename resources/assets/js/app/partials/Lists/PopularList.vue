<template>
  <div class="popular terms__lists">
    <h1 class="terms__lists--title">Popular</h1>
    <ListItems :data="data"/>
  </div>
</template>

<script>
  import ListItems from "./ListItems";

  export default {
    components:{
      ListItems
    },
    data() {
      return {}
    },
    methods: {},
    computed: {
      data(){
        return this.$store.state.content.popular
      }
    }
  }

</script>