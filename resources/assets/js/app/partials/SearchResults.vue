<template>
  <ul class="results">
    <li class="result" v-if="results" v-for="result in results" :key="result.id">
      <span class="result__title" v-html="styleTitle(result.title)"></span>
      <div class="result__icons">
        <span title="Symbols Found" alt="Symbols Found"> <span class="is-hidden-touch">Symbols:</span> {{result.totalSymbols}}</span> |
        <span title="Sounds Found" alt="Sounds Found"><span class="is-hidden-touch">Sounds:</span>{{result.totalSounds}}</span>
      </div>
    </li>

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
      }
    },
    computed: {
      results(){
        return this.$store.state.searchResults
      },
    }
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
  .result__icons{
    font-size: 1rem;
    font-weight: 500;
  }
  .highlight{
    background-color: #091d3124;
  }
</style>