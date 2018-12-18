<template>
  <div class="form-container">
    <div class="add_word">
      <h1 class="title add_word__title">Add New Buzzword</h1>
      <form action="" class="add_word__form" @keydown="clearErrors($event.target.name)">
        <div class="columns">
          <div class="field column">
            <label class="label" for="word-title">Word Title</label>
            <div class="control">
              <input id="word-title" class="input" name="word" type="text" placeholder="e.g ISP" autocomplete="off" v-model="form.word">
            </div>
            <div v-if="errors.word" class="has-text-danger">{{errors.word[0]}}</div>
          </div>
          <div class="field column">
            <label for="tags" class="label">Tags</label>
            <div class="control">
              <input id="tags" autofocus autocomplete="off" name="tags"class="input" type="text" :placeholder="tagPlaceholder"
                     @input="pickTag">
            </div>
            <ul class="filtered-tags-list">
              <li v-for="each in filteredTags" class="filtered-tags-each" @click="clickedTag(each.id)">
                <span class="">{{each.tag}}</span>
              </li>
            </ul>
            <div class="selected-tags">
              <span v-for="each in selectedTags" class="tag selected-tags__each"
                    @click="removeTag(each)">{{each.tag}}</span>
            </div>
            <div v-if="errors.tags" class="has-text-danger">{{errors.tags[0]}}</div>
          </div>
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

  let tagsCount =  5;
  export default {
    components:{SoundKeyboard, AudioUpload},
    mounted(){
      this.tagInputEl = document.querySelector('input#tags')
    },
    data() {
      return {
        form:{
          word:'',
          description: ''
        },
        addSymbol: false,
        filteredTags: '',
        selectedTags: [],
        tagPlaceholder: `Type up to ${tagsCount} related tags`,
        typedValue: '',
        tagInputEl: '',
        selectedSymbols: [],
      }
    },
    methods: {

      pickTag(e) {
        let value = e.target.value.toLowerCase()
        if (value) {
          this.filteredTags = this.tags.filter((each) => {
            if (!this.selectedTags.includes(each)) {
              return each.tag.toLowerCase().includes(value)
            }
          })
        } else {
          this.filteredTags = []
        }
      },
      clickedTag(tagID) {
        this.filteredTags = ''
        this.tagInputEl.value = ''

        if (this.selectedTags.length !== tagsCount) {
          this.tags.filter((tag) => {
            if (tag.id === tagID) {
              this.selectedTags.push(tag)
            }
          })
          this.tagInputEl.focus()
          return this.calculateRemainingTags()
        }
      },
      removeTag(tag) {
        let filtered = this.selectedTags.filter((each) => {
          return tag.id !== each.id
        })
        this.selectedTags = filtered
        this.tagInputEl.focus()
        return this.calculateRemainingTags()
      },
      calculateRemainingTags() {
        let count = this.selectedTags.length;
        if(count === 0){
          this.tagPlaceholder = `Type up to ${tagsCount} related tags`;
        }
        else if(count === tagsCount){
          this.tagPlaceholder = 'Maxed out...You cant add more...';
        }else if (count <= tagsCount){
          this.tagPlaceholder = `${tagsCount - count} more...`
        }
      },
      submit(e){
        e.preventDefault()
        this.form.tags = this.selectedTags.map(tag=> tag.id)
        this.form.audio = this.$store.state.optionalFormData.audioFileID;
        this.form.symbol = this.$store.state.optionalFormData.symbols
        this.$store.dispatch('saveWord', this.form)
      },
      clearErrors(e){
        this.$store.commit('clearFormError',e)
      } 
    },
    computed: {
      tags() {
        return this.$store.state.tags
      },
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
.optional-labels{
  font-size: 1.2rem;
}
</style>