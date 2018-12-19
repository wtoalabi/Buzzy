<template>
  <div>
    <div v-if="loaded" class="details">
      <div class="details__header">
        <div class="details__title">
          <h1>{{details.word}}</h1>
          <h3>{{details.sub_title}}</h3>
          <div class="details__tags">
            <span class="tag" v-for="tag in details.tags">{{tag.tag}}</span>
          </div>
        </div>
        <div class="details__user-info">
          <div class="details__user-info--avatar-blob">
            <img :src="details.user.avatar" alt="">
            <span class="mr-2">{{details.user.username}}</span>
            <div v-if="details.user.full_name">({{details.user.full_name}})</div>
          </div>
        </div>
      </div>
    </div>
    <loading v-else/>
  </div>
</template>

<script>

  export default {
    mounted() {
    },
    component: {},
    data() {
      return {}
    },
    methods: {},
    computed: {
      details() {
        return this.$store.state.wordDetail
      },
      loaded() {
        return !_.isEmpty(this.$store.state.wordDetail);
      }
    }
  }

</script>

<style lang="scss">
  .details{
    width: 100%;
    padding: 0 1.5rem;
  }
  .details__header{
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }
  .details__title h1{
    font-size: 3rem;
    color: white;
    font-weight: bold;
    word-break: break-word;
  }
  .details__title h3{
    margin-top: -.7rem;
  }
  .details__tags{
    display: flex;
    margin-left: .2rem;
  }
  .details__tags .tag{
    margin-right: .3rem;
    background: #1c2d3e;
    color: white;
    font-size: .8rem;
  }
  .details__user-info {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin-top: 1rem;
  }
  .details__user-info--avatar-blob{
    display: flex;
    align-items: center;
  }
  .details__user-info--avatar-blob img {
    width: 3rem;
    margin-right: .2rem;
  }
  .details__user-info--name-blob{
    display: flex;
    align-items: center;
  }
  @media screen and(min-width: 500px){
    .details__title h1{
      font-size: 6rem;
    }
  }
  @media screen and (min-width: 980px){
    .details__header{
      justify-content: space-between;
      align-items: center;
      flex-direction: row;
    }
    .details__title h1{
      font-size: 7rem;
    }
    .details__user-info{
      margin-top: 0;
    }
  }
</style>