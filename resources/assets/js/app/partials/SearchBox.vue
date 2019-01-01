<template>
  <div class="search-container" :style="search_container">
    <input autofocus type="text" placeholder="Start typing..." class="input search" @input="search"
           :style="search_input">
    <SearchResults :searchText="searchText"/>
    <span v-if="noResult" :class="visible" class="no-result">Nothing Found...</span>
  </div>
</template>

<script>
  import SearchResults from "./SearchResults";

  export default {
    components:{SearchResults},
    data() {
      return {
        visible: 'hide',
        searchText: '',
        search_container: false,
        search_input: {
          borderRadius: '2rem'
        }
      }
    },
    methods: {
      search(e) {
        this.searchText = e.target.value
          _.debounce(() => {
            this.$store.dispatch('getResult', this.searchText).then(() => {
              const searchResult = document.querySelector('.search-container ul')
              const resultRect = searchResult.getBoundingClientRect()
              this.search_container = {
                height: resultRect.height
              }
              this.setStyles(e)
            })
          }, 800)()
      },
      setStyles(e) {
        if (e.target.value) {
          this.search_input = {
            borderBottom: '0.09rem #b2beca solid',
            borderBottomRightRadius: 'unset',
            borderBottomLeftRadius: 'unset',
            boxShadow: 'none'
          },
            this.search_container = {
              background: 'rgba(255, 255, 255, 0.97)',
              boxShadow: '0px 0px 11px 1px #ffffff61'
            }
          this.visible = 'show'
        } else {
          this.search_input = {borderRadius: '2rem'}
          this.search_container = {height: 'inherit'}
          this.visible = 'hide'
        }
      }
    }
  ,
  computed: {
    noResult(){
      return _.isEmpty(this.$store.state.searchResults)
    },
  }
  }

</script>
<style scoped>
  .search-container {
    border-radius: 2rem;
    margin: 0 auto;
    width: 80%;
    display: flex;
    flex-direction: column;
    position: absolute;
  }

  .search-result {
    background-color: #ffffffd9;
  }

  .search {
    padding: 1.3rem 2rem 1.3rem 4.7rem;
    border-radius: 2rem;
    -webkit-appearance: none;
    background: white url(http://buzz.loc/svg/search.svg) no-repeat 1.8rem 60%;
    color: #1c2d3e;
    font-size: 1.2rem;
    display: flex;
    box-shadow: 0px 0px 11px 1px #ffffff61;
  }

  .search:focus, .search:hover {
    border: none
  }
  .no-result{
    text-align: center;
    padding: 1rem;
    color: black;
    font-size: 2rem;
  }
  @media screen and (min-width: 980px){
    .search{
      font-size: 1.8rem;
    }
  }
</style>