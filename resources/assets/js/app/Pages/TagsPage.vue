<template>
  <div>
    <h1 class="tag-title title">{{tag}}</h1>
    <div class="tags-list" v-if="loaded">
      <div class="tags-chunk" v-for="wordChunks in words">
        <router-link :to="`/details/${word.url}`" class="tags-item" v-for="word in wordChunks" :key="word.id">
          {{word.word}}
        </router-link>
      </div>
    </div>
    <loading v-else/>
  </div>
</template>

<script>
  export default {
    beforeRouteLeave(to, from, next) {
      this.$store.commit('clearTagWords')
      next()
    },
    mounted() {
      console.log()
    },
    data() {
      return {}
    },
    watch:{
      '$route' (to, from){

      }
    },
    methods: {},
    computed: {
      loaded() {
        return !_.isEmpty(this.$store.state.tagWords);
      },
      tag() {
        return this.$route.params.tag
      },
      words() {
        return _.chunk(this.$store.state.tagWords, 2)
      }
    }
  }

</script>
<style lang="scss">
  .tag-title {
    display: flex;
    justify-content: center;
    font-size: 3rem;
    @media screen and(min-width: 350px) {
      font-size: 4rem;
    }
    @media screen and(min-width: 450px) {
      font-size: 5rem;
    }
    @media screen and(min-width: 500px) {
      font-size: 6rem;
    }
  }

  .tags-list {
    margin: 1rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    @media screen and(min-width: 700px) {
      flex-direction: row;
      flex-wrap: wrap;
    }
  }

  .tags-chunk {
    display: flex;
    flex-direction: column;
    padding: .5rem;
    justify-content: center;
    align-items: center;
    @media screen and(min-width: 700px) {
      padding: 2rem;
      text-align: center;
    }
  }

  .tags-item {
    font-size: 2.5rem;
    @media screen and(min-width: 700px) {
      font-size: 1.5rem;
    }
  }
</style>