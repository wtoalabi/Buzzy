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
        </div>
        <div class="navbar-end">
          <div class="navbar-item" v-if="!isLoggedIn">
            <div class="tags has-addons are-medium">
              <div class="signup-tag tag is-white signup-text">Sign up with: </div>
              <div class="signup-tag twitter tag is-info" @click="login('twitter')"><a href="#"><i class="fa fa-twitter mr-6"></i><span>Twitter</span></a></div>
              <div class="signup-tag github tag is-primary" @click="login('github')"><a href="#"><i class="fa fa-github mr-6"></i><span>Github</span></a></div>
            </div>
          </div>
          <div class="navbar-item">
            <a href="/#/settings" class="pr-0">
              <img :src="user.avatar" alt="" class="mr-10 is-rounded">
            </a>
          </div>
          <div class="navbar-item has-dropdown is-hoverable" v-if="isLoggedIn">
            <div class="navbar-link">Profile
              <div class="navbar-dropdown">
                <router-link class="navbar-item" to="account-Settings">Account Settings</router-link>
                <div class="navbar-item" @click="logout">Logout</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
  export default {
    mounted(){

    },
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
        return this.$store.state.user;
      },
      isLoggedIn(){
        return !_.isEmpty(this.user);
      },
      loaded(){
        return !_.isEmpty(this.$store.state.content);
      }
    }
  }

</script>