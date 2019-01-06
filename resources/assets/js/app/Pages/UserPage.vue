<template>
  <div class="ml-32">
    <div class="user-info">
      <img :src="user.avatar" alt="">
      <div class="user-info__detail">
        <h1 class="title" v-if="user.full_name">{{user.full_name}}</h1>
        <h3>{{user.username}}</h3>
      </div>
    </div>
    <div class="">
      <Container />
    </div>
  </div>
</template>

<script>
  import Container from "../partials/UserTabs/Container";

  export default {
    beforeRouteLeave(to, from, next){
      this.$store.commit('clearUserDetails')
      this.$store.commit('clearTempUploads')
      return next()
    },
    components:{
      Container
    },
    data() {
      return {}
    },
    methods: {},
    watch:{
      '$route' (to, from){
        this.$store.commit('clearUserDetails')
        this.$store.dispatch('retrieveUserDetails', to.params.username)
      }
      },
    computed: {
      words(){
        return this.$store.state.userDetails.words;
      },
      user(){
        return this.$store.state.userDetails.user;
      },
      loaded(){
        return this.$store.state.loaded
      }
    }
  }

</script>

<style lang="scss" scoped>
  .user-info{
    display: flex;
    justify-content: flex-start;
    img{
      width: 6rem;
      height: 6rem;
      margin-right: 1rem;
    }
    .title{
      margin: 0;
    }
    .user-info__detail{
      display: flex;
      flex-direction: column;
    }
  }

</style>