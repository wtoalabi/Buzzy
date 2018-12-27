<template>
  <div>
    <h1 class="tab-title has-text-white">Your bookmarked words</h1>
    <loading v-if="gettingBookmark"/>
    <div class="bookmarks" v-else="hasBookmarks">
      <div v-for="word in userBookmarks" class="bookmark">
        <div class="tag">
          <router-link :to="`/details/${word.slug}`" class="">
            {{word.word}}
          </router-link>
        </div>
      </div>
    </div>
    <div v-if="noBookmark" class="has-text-warning">You do not have any bookmarked word yet...</div>
  </div>
</template>

<script>
  export default {
    mounted() {
      this.$store.dispatch('getUserBookmarks')
    },

    data() {
      return {}
    },
    methods: {},
    computed: {
      userBookmarks() {
        return this.noBookmark ? '' : this.bookmarks
      },
      bookmarks() {
        return this.$store.state.userDetails.bookmarks
      },
      noBookmark() {
        return this.bookmarks === 'None';
      },
      gettingBookmark() {
        return _.isEmpty(this.bookmarks)
      },
      bookmark() {
        if (this.$store.state.wordDetail.bookmarked) {
          return {
            'text': "Bookmarked",
            'color': "has-text-warning"
          }
        }
        return {
          'text': "Bookmark this word",
          'color': "has-text-danger"
        }
      }
    }
  }

</script>

<style scoped lang="scss">
  .bookmarks {
    display: flex;
    flex-wrap: wrap;
  }
  .bookmark{
    padding: .5rem;
    .tag{
      padding: 1.2rem;
    }
    a{
      font-size: 1rem;
    }
  }
</style>
