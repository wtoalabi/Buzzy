<template>
  <main>
    <Navbar />
    <Lorem />
    <Footer />
  </main>
</template>

<script>
  import Navbar from './partials/Navbar'
  import Lorem from './partials/Lorem'
  import Footer from './partials/Footer'
  export default {
    components:{Navbar, Lorem, Footer},
    data() {
      return {}
    },
    methods: {},
    computed: {}
  }

</script>