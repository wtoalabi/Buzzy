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

      <div id="navbar" class="navbar-menu">
        <div class="navbar-start">
        </div>
        <div class="navbar-end">
          <div class="navbar-item" v-if="!isLoggedIn">
            <div class="tags has-addons are-medium">
              <div class="signup-tag tag is-white signup-text">Sign up with: </div>
              <div class="signup-tag twitter tag is-info"><a href="#"><i class="fa fa-twitter mr-6"></i><span>Twitter</span></a></div>
              <div class="signup-tag github tag is-primary"><a href="#"><i class="fa fa-github mr-6"></i><span>Github</span></a></div>
            </div>
          </div>
          <div class="navbar-item">
            <a href="/#/settings" class="pr-0">
              <img :src="user.avatar" alt="" class="mr-10 is-rounded">
            </a>
          </div>
          <div class="navbar-item has-dropdown is-hoverable" v-if="isLoggedIn">
            <div class="navbar-link">Settings
              <div class="navbar-dropdown">
                <div class="navbar-item">Logout</div>
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
    methods: {},
    computed: {
      user(){
        return this.$store.state.user;
      },
      isLoggedIn(){
        return !_.isEmpty(this.user);
      },

    }
  }

</script>