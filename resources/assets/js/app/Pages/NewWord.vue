<template>
  <div class="form-container">
    <div class="add_word">
      <h1 class="title add_word__title">Add New Buzzword</h1>
      <form action="" class="add_word__form" @keydown="clearErrors($event.target.name)">
        <div class="columns">
          <div class="field column">
            <label class="label" for="word-title">Word Title</label>
            <div class="control">
              <input id="word-title" class="input" name="word" type="text" placeholder="A commonly known but brief title or an Acronymn. E.g ISP" autocomplete="off" v-model="form.word">
            </div>
            <div v-if="errors.word" class="has-text-danger">{{errors.word[0]}}</div>
          </div>
          <div class="field column">
            <label class="label">Tags</label>
            <TagsSelector />
            <div v-if="errors.tags" class="has-text-danger">{{errors.tags[0]}}</div>
          </div>
        </div>
        <div class="columns">
          <div class="field column">
            <label for="sub_title" class="label">Buzzword in Full (Optional)</label>
            <div class="control">
              <input id="sub_title" class="input" name="sub_title" placeholder="E.g Internet Service Provider" v-model="form.sub_title"/>
            </div>
          </div>
          <div v-if="errors.sub_title" class="has-text-danger">{{errors.sub_title[0]}}</div>
        </div>
        <div class="">
          <div class="field">
            <label for="description" class="label">Description</label>
            <div class="control">
              <textarea id="description" class="textarea" name="description" placeholder="How would you explain this word?" v-model="form.description"/>
            </div>
          </div>
          <div v-if="errors.description" class="has-text-danger">{{errors.description[0]}}</div>
        </div>
        <h1 class="optional">Optional</h1>
        <div class="columns">
          <div class="column audio-column">
          <div class="field add-sound">
            <label class="label optional-labels">Upload Audio file</label>
            <AudioUpload />
            <div v-if="errors.audio" class="has-text-danger">{{errors.audio[0]}}</div>
          </div>
          </div>
          <div class="column field">
            <label class="label optional-labels">Add Phonetic Sound</label>
            <SoundKeyboard/>
          </div>
        </div>
        <div class="submit__buttons">
          <div class="">
            <button class="button is-warning" type="submit" @click="submit">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import SoundKeyboard from "../partials/SoundKeyboard";
  import AudioUpload from "../partials/Lists/AudioUpload";
  import TagsSelector from "../partials/TagsSelector";
  export default {
    components:{SoundKeyboard, AudioUpload, TagsSelector},
    data() {
      return {
        form:{
          word:'',
          sub_title: '',
          description: ''
        },
      }
    },
    methods: {
      submit(e){
        e.preventDefault()
        this.form.tags = this.$store.state.formData.tags
        this.form.suggestedTags = this.$store.state.formData.suggestedTags
        this.form.audio = this.$store.state.formData.audioFileID;
        this.form.symbol = this.$store.state.formData.symbols
        this.$store.dispatch('saveWord', this.form)
      },
      clearErrors(e){
        this.$store.commit('clearFormError',e)
      } 
    },
    computed: {
      errors(){
        return this.$store.state.formErrors;
      }
    }
  }

</script>
<style scoped>
  ::placeholder {
    color: #8795a1;
  }
</style>