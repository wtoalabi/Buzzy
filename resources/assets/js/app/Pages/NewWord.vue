<template>
  <div class="add_word">
    <h1 class="title">Add New Buzzword</h1>
    <form action="" class="add_word__form">
      <div class="columns">
        <div class="field column">
          <label class="label" for="word-title">Word Title</label>
          <div class="control">
            <input id="word-title" class="input" type="text" placeholder="e.g ISP">
          </div>
        </div>
        <div class="field column">
          <label for="tags" class="label">Tags</label>
          <div class="control">
            <input id="tags" class="input" type="text" placeholder="Type up to 5 related tags">
          </div>
        </div>
      </div>
      <div class="">
        <div class="field">
          <label for="description" class="label">Description</label>
          <div class="control">
            <textarea id="description" class="textarea" placeholder="Give description of this word" />
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  export default {
    data() {
      return {}
    },
    methods: {},
    computed: {}
  }

</script>
<style scoped>
  .add_word{
    padding: 2rem;
    background-color: #fff;
    margin: 2rem 4rem;
    border-radius: 1rem;
  }

  .add_word__form {
    display: flex;
    flex-direction: column;
  }

  @media screen and (min-width: 980px) {
    .add_word__form {
    }
  }
</style>