<template>
  <div>
      <router-link v-for="item in data" :key="item.id" :to="item.url" class="items">
        <span class="">{{item.title}}</span>
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