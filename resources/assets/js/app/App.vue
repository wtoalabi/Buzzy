<template>
  <main>
    <div class="wrapper">
      <Navbar/>
      <section class="main-content" v-if="loaded">
        <router-view/>
      </section>
        <div v-else>
          <loading/>
        </div>
    </div>
    <Footer/>
  </main>
</template>

<script>
  import Navbar from "./partials/Navbar";
  import Footer from "./partials/Footer";

  export default {
    mounted() {
      this.$store.dispatch('initialLoading')
    },
    components: {Navbar, Footer},
    data() {
      return {}
    },
    methods: {},
    computed: {
      loaded() {
        return this.$store.state.loaded;
      },
    }
  }
</script>
<style>

</style>