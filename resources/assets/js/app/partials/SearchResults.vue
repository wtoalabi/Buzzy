<template>
  <ul class="results" @click="clearResults">
    <router-link :to="`details/${result.slug}`" class="result" v-if="results" v-for="result in results" :key="result.id">
      <span class="result__title" v-html="styleTitle(result.word)"></span>
      <div class="result__counts">
        <div class="result__counts--icons">
          <span title="Views Count" alt="Views Count" class="result__icons mr-6"> <i class="fa fa-eye pr-1"></i> {{result.viewsCount}}</span>
          <span title="Descriptions Count" alt="Total Descriptions" class="result__icons mr-6"> <i class="fa fa-comments-o pr-1"></i> {{result.totalDescriptionsCount}}</span>
          <span title="Total Tags" alt="Total Tags" class="result__icons"><i class="fa fa-tag mr-6"></i>{{result.totalTagsCount}}</span>
        </div>
      </div>
    </router-link>

  </ul>
</template>

<script>
  export default {
    props: ['searchText'],
    data() {
      return {}
    },
    methods: {
      styleTitle(title){
        let regex = new RegExp(this.searchText, 'gi')
        return title.replace(regex, `<span class="highlight">${this.searchText}</span>`)
      },
      clearResults(){
        this.$store.dispatch('clearSearchResults')
      },
    },
    computed: {
      results(){
        return this.$store.state.searchResults
      },
    },
  }

</script>

<style lang="scss">
  .results{
  }
  .result{
    padding: 1rem;
    border-bottom: 1px solid #b2beca;
    font-size: 1rem;
    color: #0c1c2b;
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-transform: uppercase;
    @media screen and(min-width: 500px){
      font-size: 1.5rem;
    }
    @media screen and(min-width: 750px){
      font-size: 2rem;
    }
  }
  .result a{}
  .result:last-of-type{
    border-bottom: none;
  }
  .result__title{
    flex: 1;
  }
  .result__counts{
    display: flex;
    font-size: 1rem;
    font-weight: 500;
    flex-direction: column;
  }
  .result__counts--icons{
    display: flex;
    justify-content: space-evenly;
  }
  .result__icons{
    color: #091d3196;
    font-size: .9rem;
  }
  .highlight{
    background-color: #ffdd57;
  }
</style>