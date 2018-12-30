<template>
  <div>
    <div class="loading-container" v-if="!isError">
      <div class="loading-backdrop"></div>
      <div class="loading">
        <vue-spinner class="loading" size="massive" message="buzzzzzin..."></vue-spinner>
      </div>
    </div>
    <div v-else>
      {{error}}
    </div>
  </div>
</template>

<script>
  import VueSpinner from 'vue-simple-spinner'
  export default {
    components:{VueSpinner},
    computed: {
      isError(){
        return !_.isEmpty(this.$store.state.error)
      },
      error(){
        return this.$store.state.error.response.data
      }
    }

  }
</script>

<style lang="scss" scoped>
  .loading-container {
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
    bottom: 0px;
    text-align: center;

    .loading-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background-color: lightgray;
      opacity: 0.5;
      z-index: 9998;
    }

    .loading {
      z-index: 9999;
      position: fixed;
      display: inline-block;
      left: 50%;
      top: 50%;
      -ms-transform: translate(-50%,-50%);
      -moz-transform: translate(-50%,-50%);
      -webkit-transform: translate(-50%,-50%);
      transform: translate(-50%,-50%);
    }
  }
</style>
