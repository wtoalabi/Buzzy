<template>
  <div>
    <loading  v-if="gettingDescriptions"/>
    <div class="descriptions-list" v-else>
      <div class="descriptions" v-for="description in descriptions">
        <router-link :to="`/details/${description.word}#${description.id}`" class="description__link ">{{description.body}}</router-link>
        <!--<span class="tag mr-6 ml-6">on</span>-->
        <div class="descriptions__footer">
          <span class="descriptions__word mr-6 is-warning">on {{description.word}}</span>
          <span class="descriptions__time">{{description.date_created}}</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    mounted() {
      return this.$store.dispatch('getUserDescriptions', this.user)
    },
    data() {
      return {}
    },
    methods: {},
    computed: {
      descriptions(){
        return this.$store.state.userDetails.descriptions
      },
      user(){
        return this.$store.state.userDetails.user.username
      },
      gettingDescriptions(){
        return _.isEmpty(this.descriptions)
      }
    }
  }

</script>
<style lang="scss" scoped>
  .descriptions-list{
    .descriptions{
      display: flex;
      flex-direction: column;
      background: #00bcd41c;
      padding: .5rem;
      margin: .4rem 0;
      border-radius: .5rem;
      .descriptions__footer{
        display: flex;
        flex-direction: column;
        @media screen and (min-width:600px){
          flex-direction: row;
          justify-content: space-between;
          align-items: center;
        }
        .description__link{}
        .descriptions__word{
          font-size: 1.2rem;
          font-weight: bold;
        }
        .descriptions__time{
          font-size: .8rem;
        }
      }

    }
  }
  /*.descriptions{
    margin: .5rem;
    font-size: 1.2rem;
  }*/
</style>