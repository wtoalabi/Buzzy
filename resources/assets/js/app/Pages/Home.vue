<template>
  <div>
  <div class="mt-12 home-box">
    <SearchBox />
  </div>
  <HomeList  v-if="loaded"/>
    <loading v-else/>
  </div>
</template>

<script>
  import SearchBox from "../partials/SearchBox";
  import HomeList from "../partials/HomeList";
  export default {
    mounted(){
    },
    beforeRouteLeave(to, from, next){
      this.$store.commit('clearHomeList')
      return next()
    },
    components:{SearchBox,HomeList},
    data() {
      return {}
    },
    methods: {},
    computed: {
      loaded() {
        return !_.isEmpty(this.$store.state.content);
      },
    }
  }


</script>

<style>
</style>