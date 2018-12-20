<template>
  <div>
    <div v-if="loaded" class="details">
      <div class="details__header">
        <div class="details__title">
          <h1>{{details.word}}</h1>
          <h3>{{details.sub_title}}</h3>
          <div class="details__tags">
            <span class="mr-2 tag">Added by {{details.user.username}}</span>
            <span class="tag details__tags--link" v-for="tag in details.tags">
              <router-link to="#">{{tag.tag}}</router-link>
            </span>
          </div>
        </div>
      </div>
      <template>
        <div class="description-divider">Descriptions</div>
        <DescriptionsList />
      </template>
    </div>
    <loading v-else/>
  </div>
</template>

<script>

  import DescriptionsList from "../partials/DescriptionsList";

  export default {
    components: {DescriptionsList},
    mounted() {
    },
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
  .description-divider{
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    grid-gap: 20px;
    align-items: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin-top: 2rem;
  }
  .description-divider:before,
  .description-divider:after{
    display: block;
    content: '';
    height: 10px;
    background: linear-gradient(to var(--direction, left), #607d8b, transparent)
  }
  .description-divider:after{
    --direction: right;
  }
</style>