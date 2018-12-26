<template>
  <div>
    <h1 class="tab-title has-text-white">User Contributed Words</h1>
    <div class="words" v-if="hasWords">
      <div v-for="words in chunkedWords" class="chunked-words">
        <div class="" v-for="word in words">
          <router-link :to="`/details/${word.slug}`" class="word tag">
            {{word.word}}
            <div class="word__details">
              <span><i class="fa fa-comments"></i>
                {{word.descriptions_count}}
              </span>
            </div>
          </router-link>
        </div>
      </div>
    </div>
    <div class="has-text-warning" v-else>User has not contributed any word yet...</div>
  </div>
</template>

<script>
  export default {
    data() {
      return {}
    },
    methods: {},
    computed: {
      chunkedWords() {
        return _.chunk(this.$store.state.userDetails.words, 6)
      },
      hasWords() {
        return !_.isEmpty(this.$store.state.userDetails.words)
      }
    }
  }

</script>
<style lang="scss">
  /*TODO Remove the tabs line*/
  @import "../../../../sass/custom/components/tabs";
  .words {
    display: flex;
    flex-wrap: wrap;

    .chunked-words {
      display: flex;
      flex-direction: column;
      margin: .5rem;
      width: 100%;
      @include media(950px) {
        width: 30%;
      }
      a.tag{
        text-decoration: none;
      }
    }
    .word {
      font-size: 1rem;
      display: flex;
      justify-content: space-between;
      margin: .5rem 0;
      width: 100%;
      color: #091d31;
      &:hover{
        background-color: #9E9E9E;
        color: #fff;
      }
    }
  }
</style>