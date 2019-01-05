<template>
  <div>
    <div class="tags-all">
      <div class="tags__chunked" v-for="tagsList in chunkedTags">
        <div class="tags__grouped" v-for="groupedTags in tagsList">
          <h1 class="">{{groupedTags.key}}</h1>
          <div class="tags__list">
            <div class="tags_tag" v-for="tag in groupedTags.value">
              <router-link class="tag" :to="`/tags/${tag.slug}`">{{tag.slug}}</router-link>
            </div>
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
      tags() {
        return this.$store.state.tags.sort((a, b) => {
          return a.tag > b.tag ? 1 : -1
        })
      },
      groupedTags() {
        let grouped = _.groupBy(this.tags, (e) => e.slug[0])
        return _.map(grouped, (value, key) => {
          return {key, value}
        })
      },
      chunkedTags() {
        return _.chunk(this.groupedTags, 4)
      }
    }
  }

</script>
<style lang="scss">
  .tags-all {
    padding: 1rem;
    display: flex;
    width: 100%;
    justify-content: space-around;

    .tags__chunked {
      flex: 1;
    }
    .tags__grouped {
      margin: 1rem 2rem;
      h1 {
        text-transform: uppercase;
        font-size: 2rem;
      }
      .tags__list{
        display: flex;
        .tags_tag{
          margin: .5rem;
        }
      }
    }
  }
</style>