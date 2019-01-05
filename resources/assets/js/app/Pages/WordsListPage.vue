<template>
  <div>
    <div class="chunked-words">
      <div class="grouped-words" v-for="(groupedWords,index) in chunkedList">
        <h1 class="title group-title">{{index}}</h1>
        <div class="words">
          <div class="word" v-for="word in groupedWords">
            <router-link class="tag" :to="`details/${word}`">{{word}}</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {}
    },
    methods: {},
    computed: {
      chunkedList() {
        return this.$store.state.wordsList;
      },
    }
  }

</script>
<style lang="scss" scoped>
  .chunked-words {
    display: flex;
    width: 100%;
    justify-content: space-around;
    text-transform: capitalize;
    flex-wrap: wrap;
    margin: 2rem;
    .grouped-words {
      flex-basis: 100%;
      padding: 1.3rem;
      @media screen and (min-width: 600px){
        flex-basis: 50%;
      }
      @media screen and (min-width: 980px){
        flex-basis: 33.3%;
      }
      .group-title{
        margin-bottom: .5rem;
        text-align: center;
        @media  screen and (min-width:400px){
          text-align: left;
        }
      }
      .words{
        display: flex;
        flex-wrap: wrap;
        .word{
          margin: .5rem;
          a{
            text-decoration: none;
            text-transform: lowercase;
            color: #091d31;
            font-weight: bold;
          }
        }
      }
    }
  }
</style>