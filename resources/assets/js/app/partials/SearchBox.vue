<template>
  <div class="search-container" :style="searching_container">
    <input autofocus type="text" placeholder="Start typing..." class="input search" @input="search"
           :style="searching_input">
    <!--<span class="search-result">Hello</span>-->
  </div>
</template>

<script>
  export default {
    mounted(){
      let container = document.querySelector('.search-container')
    },
    data() {
      return {
        searching_container: false,
        searching_input: {
          borderRadius: '2rem'
        }
      }
    },
    methods: {
      search(e) {
        this.setStyles(e)
      },
      setStyles(e) {
        if (e.target.value) {
          this.searching_input = {
            borderBottom: '0.09rem #b2beca solid',
            borderBottomRightRadius: 'unset',
            borderBottomLeftRadius: 'unset',
            boxShadow: 'none'
          },
            this.searching_container = {
              height: '30rem',
              background: '#ffffffde',
              boxShadow: '0px 0px 11px 1px #ffffff61'
            }
        } else {
          this.searching_input = {borderRadius: '2rem'}
          this.searching_container = {height: 'inherit'}
        }
      }
    }
  ,
  computed: {
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
  @media screen and (min-width: 980px){
    .search{
      font-size: 1.8rem;
    }
  }
</style>