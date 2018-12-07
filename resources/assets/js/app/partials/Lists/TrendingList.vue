<template>
  <div class="trending terms__lists">
    <h1 class="terms__lists--title">Trending</h1>
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
        return this.$store.state.content.trending
      }
    }
  }

</script>