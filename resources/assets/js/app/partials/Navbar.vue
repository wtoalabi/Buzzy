<template>
  <header>
    <nav class="navbar is-transparent is-dark is-fixed-top">
      <div class="navbar-brand pl-12">
        <a class="navbar-item has-text-white logo" href="/#/">
          Buzzwords
        </a>
        <div class="navbar-burger" data-target="navbar">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>

      <div id="navbar" class="navbar-menu" v-if="loaded">
        <div class="navbar-start">
          <div class="navbar-item menu-item">
            <router-link to="/words-list" class="button p-6 is-medium is-warning"><i class="fa fa-list mr-10 mt-6 has-text-white"></i>Main Index</router-link>
          </div>
        </div>
        <div class="navbar-end">
          <div class="navbar-item" v-if="!loggedIn">
            <div class="tags has-addons are-medium">
              <div class="signup-tag tag is-white signup-text is-size-5">Sign up with: </div>
              <div class="signup-tag twitter tag is-info is-size-5" @click="login('twitter')"><a href="#"><i class="fa fa-twitter mr-6"></i><span>Twitter</span></a></div>
              <div class="signup-tag github tag is-primary is-size-5" @click="login('github')"><a href="#"><i class="fa fa-github mr-6"></i><span>Github</span></a></div>
            </div>
          </div>
          <template v-else>
          <div class="navbar-item avatar">
            <router-link :to="`/user/${user.username}`" class="pr-0">
              <img :src="user.avatar" alt="" class="mr-10 is-rounded">
            </router-link>
          </div>
          <div class="navbar-item">
            <router-link to="/add-new" class="button p-14 is-medium is-warning"><i class="fa fa-plus mr-10 mt-6 has-text-primary"></i>New Buzz</router-link>
          </div>
          <template class="">
            <div class="navbar-item"><router-link class="" :to="`/user/${user.username}`">Profile</router-link></div>
            <div class="navbar-item"><a class="" @click.prevent="logout">Logout</a></div>
          </template>
          </template>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
  export default {
    data() {
      return {}
    },
    methods: {
      logout(){
        this.$store.dispatch('logout')
      },
      login(provider){
        this.$store.dispatch('login', provider)
      }
    },
    computed: {
      user(){
        return this.$store.state.loggedInUser;
      },
      loaded(){
        return this.$store.state.loaded;
      },
      loggedIn(){
        return !_.isEmpty(this.$store.state.loggedInUser)
      }
    }
  }

</script>


<style lang="scss">
  .menu-item{
    font-size: 1.7rem;
    margin-top: 3px;
    a.button{
      //padding: 0 16px;
      background-color: #42a9ebbd;
      color: #000;
      @media screen and(min-width: 950px){
        color: #fff;
      }
      &:hover{
        background-color: #607D8B;
        color: white;
        border: 1px solid white;
      }
    }
  }
  @media screen and (max-width:950px){
    .avatar{
      display: none;
    }
  }
</style>