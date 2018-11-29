<template>
  <main>
    <Navbar/>
    <div class="content" v-if="loaded">
      <router-view/>
    </div>
    <template v-else>
      <loading/>
    </template>
    <Footer/>
  </main>
</template>

<script>
  import Navbar from './partials/Navbar'
  import Footer from './partials/Footer'

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
        return !_.isEmpty(this.$store.state.content);
      }
    }
  }
</script>