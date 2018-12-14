<template>
  <div class="terms__lists--section">
      <router-link v-for="item in data" :key="item.id" :to="`details/${item.url}`" class="items">
        <span class="">{{item.word}}</span>
      </router-link>
  </div>
</template>

<script>
  export default {
    props:['data'],
    data() {
      return {}
    },
    methods: {},
    computed: {}
  }

</script>

<style>

</style>