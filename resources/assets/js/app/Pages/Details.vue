<template>
  <div>

    <div v-if="loaded" class="details">
      <div class="details__header">
        <div class="details__title">
          <h1>{{details.word}}</h1>
          <h3>{{details.sub_title}}</h3>
          <div class="details__tags">
            <router-link :to="`/user/${details.user.username}`" class="mr-2 tag details__user">Added by:
              {{details.user.username}}
            </router-link>
            <span class="tag details__tags--link" v-for="tag in details.tags">
              <router-link :to="`/tags/${tag.slug}`">{{tag.tag}}</router-link>
            </span>
          </div>
        </div>
        <div class="details__bookmark_with_view">
          <div v-if="isLoggedIn" @click="bookmarkThis" class="has-text-link details__bookmark" :title="bookmark.text">
            <i class="fa fa-bookmark" :class="bookmark.color"></i>
            <span class="ml-6">{{bookmark.text}}</span>
          </div>
          <span title="Views Count"><i class="fa fa-eye mr-6"></i>{{details.viewsCount}}</span>
        </div>
      </div>
      <template>
        <div class="description-divider">Descriptions</div>
        <NewDescription/>
        <DescriptionsList/>
      </template>
    </div>
    <loading v-else/>
  </div>
</template>

<script>

  import DescriptionsList from "../partials/DescriptionsList";
  import NewDescription from "../partials/NewDescription";

  export default {
    components: {DescriptionsList, NewDescription},
    mounted() {
    },
    data() {
      return {}
    },
    methods: {
      bookmarkThis() {
        this.$store.dispatch('bookmarkThis', this.details.id)
      }
    },
    computed: {
      details() {
        return this.$store.state.wordDetail
      },
      loaded() {
        return !_.isEmpty(this.$store.state.wordDetail);
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
<style lang="scss">
  .details__bookmark {
    cursor: pointer;
    margin-right: 10px;
  }
  .details__bookmark_with_view{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

</style>