<template>
  <footer class="hero is-dark">
    <div class="hero-body has-text-centered p-12 has-text-white footer-wrapper">
      <h1>&copy From 2018 - {{year}}</h1>
      <span>Built with <i class="fa fa-heart has-text-danger"></i> on Vuejs, Laravel, and  Bulma</span>
      <h1>Say hi on <i class="fa fa-twitter has-text-link"></i> or <i class="fa fa-envelope"></i></h1>
    </div>
  </footer>
</template>

<script>
  let now = new Date().getFullYear();
  export default {
    data() {
      return {
        year: now === 2018 ? 'Till Date' : now,
      }
    },
    methods: {},
    computed: {}
  }

</script>