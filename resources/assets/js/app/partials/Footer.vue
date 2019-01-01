<template>
  <section class="footer">
      <h1>&copy From 2018 - {{year}}</h1>
      <span>Built with <i class="fa fa-heart has-text-danger"></i> on Vuejs, Laravel, and  Bulma</span>
      <h1>Say hi on <a target="_blank" href="http://www.twitter.com/wtoalabi"><i class="fa fa-twitter has-text-link"></i></a></h1>
  </section>
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