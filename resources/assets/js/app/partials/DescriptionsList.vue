<template>
  <div class="details__descriptions">
    <div v-for="description in descriptions" class="details__description">
      <div class="description__owner">
        <router-link to="#">
          <img :src="description.user.avatar" alt="">
          <h3>{{description.user.username}}</h3>
          <!--<h2 v-if="description.user.full_name" class="name">{{description.user.full_name}}</h2>-->
        </router-link>
        <div class="description__owner-info">
          <span class="description__owner-info--count tag" title="Total number of words authored">
            <span class=""><i class="fa fa-file-word-o mr-4"></i></span>
            <span>{{description.user.words_count}}</span>
          </span>
          <span class="tag description__owner-info--count" title="Total number of descriptions added">
            <span class=""><i class="fa fa-comments-o mr-4"></i></span>
            <span>{{description.user.descriptions_count}}</span>
          </span>
        </div>
      </div>
      <div class="description__details">
        <div class="description__icons">
          <code v-if="description.symbol">{{description.symbol.body}}</code>
          <a v-if="description.audio_file" title="Listen to Pronounciation" class=""><i class="fa fa-volume-up mr-4 has-text-info"></i>Listen to pronounciation</a>
        </div>
        <div class="description__texts">
          {{description.body}}
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
      descriptions() {
        return this.$store.state.wordDetail.descriptions
      }
    }
  }

</script>

<style>
  .details__descriptions {
    padding: 1rem;
    margin: 0 0 1rem 0;
  }
  .details__description {
    border-radius: 0 0 1rem 1rem;
    padding: 1rem;
    background: #3da9f90a;
    margin-bottom: 1rem;
    box-shadow: 0 0 0.3rem 0 #607D8B;
    display: flex;
    justify-content: space-around;
    align-items: center;
  }
  .details__description:nth-child(odd) {
    border-radius: 1rem 1rem 0 0;
  }
  .description__owner{
    margin-right: 2rem;
    flex-basis: 15%;
  }
  .description__owner a{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }
  .description__owner img{
    width: 4rem;
    border-radius: 50%;
    margin: 0 1rem;
  }
  .description__owner .name{
    color: #f0f8ff8f;
  }
  .description__details{
    flex: 2;
  }
  .description__icons{
    display: inline-flex;
    justify-content: space-between;
    flex-direction: column;
  }
  .description__icons code{
    background-color: #ffffff;
    color: #091d31;
    font-size: 1.1rem;
    padding: .3rem;
    font-weight: 700;
  }
  .description__texts{
    padding: .5rem 1rem;
  }
  .description__owner-info{
    display: flex;
    //flex-direction: column;
  }
  .description__owner-info > span{
    margin-right: .4rem;
  }
  span.description__owner-info--count{
    display: flex;
    justify-content: space-between;
  }
  @media screen and (max-width: 350px){
    .description__icons code{
      font-size: .65rem;
    }
  }
  @media screen and (max-width: 500px){
    .details__description{
      flex-direction: column-reverse;
    }
    .details__description .description__owner{
      width: 3rem;
    }

  }
  @media screen and (min-width: 750px){
    .description__icons{
      flex-direction: row;
      display: flex;
    }
    .description__owner{
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .description__owner img{
      margin: 0 auto;
    }
  }
</style>