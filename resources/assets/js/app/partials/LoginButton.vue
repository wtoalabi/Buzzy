<template>
  <div>
    <div class="tags has-addons are-small login-buttons">
      <div class="tag is-white login-button">Sign up with: </div>
      <div class="twitter tag is-info login-button" @click="login('twitter')"><a href="#" class="has-text-white"> <i class="fa fa-twitter mr-6"></i><span>Twitter</span></a></div>
      <div class="github tag is-primary login-button" @click="login('github')"><a href="#"><i class="fa fa-github mr-6"></i><span>Github</span></a></div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {}
    },
    methods: {
      login(provider){
        this.$store.dispatch('login', provider)
      }
    },
    computed: {}
  }

</script>

<style scoped lang="scss">
  /*TODO Remove the tabs line*/
  @import "../../../sass/custom/components/functions";
  .login-buttons{
    .login-button{
      @include media(300px){
        font-size: .75rem;
      }
      @include media(330px){
        font-size: .8rem;
      }
      @include media(350px){
        font-size: .8rem;
      }
      @include media(400px){
        font-size: 1rem;
      }
      @include media(499px){
        font-size: .7rem;
      }
      @include media(520px){
        font-size: .8rem;
      }
      @include media(589px){
        font-size: 1rem;
      }
      @include media(700px){
        font-size: 1.2rem;
      }
      font-size: .5rem;
    }
  }
</style>