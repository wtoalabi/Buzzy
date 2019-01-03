<template>
  <div>
    <div class="new_description">
      <div class="has-text-warning no-description" v-if="noDescription">This word has no description yet...be the first!</div>
      <span class="new_description__buttons">
        <button v-if="loggedIn" class="button is-link button" @click="clickedButton">{{toggleButtonText}}</button>
        <span v-else><LoginButton/></span>
      </span>
    </div>
    <div v-if="openForm" class="new_description__section">
      <form action="" class="add_word__form" @keydown="clearErrors($event.target.name)">
        <div class="">
          <div class="field">
            <label for="description" class="label">Description</label>
            <div class="control">
              <textarea id="description" class="textarea" name="description" placeholder="How would you explain
                this word?" v-model="form.description"/>
            </div>
          </div>
          <div v-if="errors.description" class="has-text-danger">{{errors.description[0]}}</div>
        </div>
        <h1 class="optional">Optional</h1>
        <div class="columns">
          <div class="column audio-column">
            <div class="field add-sound">
              <label class="label optional-labels">Upload Audio file</label>
              <AudioUploads />
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
  import SoundKeyboard from "./SoundKeyboard";
  import LoginButton from "./LoginButton";
  import AudioUploads from "./AudioUploads";


  export default {
    components:{
      SoundKeyboard,LoginButton,AudioUploads
    },
    data() {
      return {
        openForm: false,
        form:{
          description: ''
        }
      }
    },
    methods: {
      submit(e){
        e.preventDefault()
        this.form.word = this.word.id
        this.form.audio = this.$store.state.uploads.audioID;
        this.form.symbol = this.$store.state.formData.symbols
        this.$store.dispatch('saveDescription', {'form':this.form,'slug': this.word.slug})
      },
      clickedButton() {
        this.openForm ^= true
      },
      clearErrors(e){
        this.$store.commit('clearFormError',e)
      },
    },
    computed: {
      toggleButtonText(){
        return  this.openForm ? 'Close' : 'Add New Description'
      },
      errors(){
        return this.$store.state.formErrors;
      },
      word(){
        return this.$store.state.wordDetail
      },
      noDescription(){
        return _.isEmpty(this.$store.state.wordDetail.descriptions)
      },
      loggedIn(){
        return !_.isEmpty(this.$store.state.loggedInUser)
      }
    }
  }

</script>

<style lang="scss">
  /*TODO Remove the tabs line*/
  @import "../../../sass/custom/components/tabs";
  ::placeholder {
    color: black;
  }
  .new_description {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    .new_description__buttons{
      width: 100%;
      display: flex;
      justify-content: center;
    }
    .button {
      margin: 1rem;
    }
    .no-description{
      margin: .5rem;
      text-align: center;
    }
  }
  @include media(500px) {
    .new_description {
      flex-direction: row;
      justify-content: space-between;

      .button {
        margin: 0 1rem;
      }
      .new_description__buttons {
        justify-content: flex-end;
      }
    }
  }
    .new_description__section {
      margin: .5rem 1rem;
      background: #fff;
      padding: 1rem;
      border-radius: 1rem 1rem 0 0;
    }
</style>