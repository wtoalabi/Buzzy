<template>
  <div v-if="isLoggedIn">
    <span @click="clicked" class="tag is-primary description__likes" :title="liked(description).text"><i class="fa fa-heart mr-4" :class="liked(description).color"></i>{{description.like_counts}}</span>
  </div>
</template>

<script>
  export default {
    props:['description'],
    data() {
      return {}
    },
    methods: {
      clicked(e){
        this.$store.dispatch('updateDescriptionLikes',this.description.id)
      },
      liked(){
        if(this.description.liked){
          return {
            'color' : 'has-text-warning',
            'text': 'Unlike'
          }
        }
        return {
          'color': 'has-text-danger',
          'text' : 'Like'
        }
      }
    },
    computed: {}
  }

</script>

<style>
  .description__likes{
    cursor: pointer;
  }
</style>