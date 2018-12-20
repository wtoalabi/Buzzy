<template>
  <ul class="results" @click="clearResults">
    <router-link :to="`details/${result.slug}`" class="result" v-if="results" v-for="result in results" :key="result.id">
      <span class="result__title" v-html="styleTitle(result.word)"></span>
      <div class="result__counts">
        <div class="result__counts--icons">
          <span title="Symbols Found" alt="Total Descriptions" class="result__icons--symbol mr-6"> <i class="fa fa-comments-o pr-1"></i> {{result.totalDescriptionsCount}}</span>
          <span title="Total Tags" alt="Total Tags" class="result__icons--tags"><i class="fa fa-tag mr-6"></i>{{result.totalTagsCount}}</span>
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

<style>
  .results{
  }
  .result{
    padding: 1rem;
    border-bottom: 1px solid #b2beca;
    font-size: 2rem;
    color: #0c1c2b;
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-transform: uppercase;
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
  .result__icons--tags{
    color: #091d3196;
  }
  .result__icons--symbol{
    color: #091d3196;
  }
  .result__icons--sound{
    color: #6084bc;
  }
  .highlight{
    background-color: #091d3124;
  }
</style>