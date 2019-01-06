<template>
  <div>
    <loading  v-if="gettingDescriptions"/>
    <div class="" v-else>
      <div class="" v-for="description in descriptions">
        <span>{{description.date_created}}</span>
        <span>{{description.word}}</span>
        <router-link :to="`/details/${description.word}#${description.id}`" class="">{{description.body}}</router-link>
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