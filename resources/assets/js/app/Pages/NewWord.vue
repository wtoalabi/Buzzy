<template>
  <div class="form-container">
    <div class="add_word">
      <h1 class="title add_word__title">Add New Buzzword</h1>
      <form action="" class="add_word__form">
        <div class="columns">
          <div class="field column">
            <label class="label" for="word-title">Word Title</label>
            <div class="control">
              <input id="word-title" class="input" type="text" placeholder="e.g ISP" autocomplete="off" v-model="form.title">
            </div>
          </div>
          <div class="field column">
            <label for="tags" class="label">Tags</label>
            <div class="control">
              <input id="tags" autofocus autocomplete="off" class="input" type="text" :placeholder="tagPlaceholder"
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
          </div>
        </div>
        <div class="">
          <div class="field">
            <label for="description" class="label">Description</label>
            <div class="control">
              <textarea id="description" class="textarea" placeholder="How would you explain this word?" v-model="form.description"/>
            </div>
          </div>
        </div>
        <h1 class="optional">Optional</h1>
        <div class="columns">
          <div class="column field add-sound">
            <button class="button is-link"><i class="fa fa-upload mr-4"></i>Upload a sound bit</button>
            <p><em>Max size should be 15kb</em></p>
          </div>
          <div class="column field">
            <label for="symbol" class="label">Add Phonetic Sound</label>
            <div class="symbol_input">
              <input id="symbol" type="text" class="input" placeholder="e.g CPU = /siːpiːˈjuː/" v-model="soundSymbols" disabled/>
              <a class="fa fa-keyboard-o ml-10 symbol_input__keyboard" :class="keyboardStyle" @click="showKeyboard" title="Open Phonetics Keyboard"></a>
            </div>
            <SoundKeyboard v-if="addSymbol" @symbolsAdded="symbolsAdded" @removeLastSymbol="removeLastSymbol" @closeKeyboard="closeKeyboard" :selected-symbols="selectedSymbols"/>
          </div>
        </div>
        <div class="submit__buttons">
          <div class="">
            <button class="button is-warning" type="submit" @click="submit">Add</button>
          </div>
          <div class="submit__button--end">
            <button class="button is-danger" type="reset">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
  import SoundKeyboard from "../partials/SoundKeyboard";

  let tagsCount =  5;
  export default {
    components:{SoundKeyboard},
    mounted(){
      this.tagInputEl = document.querySelector('input#tags')
    },
    data() {
      return {
        form:{
          title:'',
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
      closeKeyboard(){
        this.addSymbol = false
      },
      removeLastSymbol(){
        this.selectedSymbols.pop()
      },
      symbolsAdded(a){
        this.selectedSymbols.push(a)
      },
      showKeyboard(){
        this.addSymbol ^= true
      },
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
        this.form.symbols = this.selectedSymbols
        console.dir(this.form)
        //console.dir(this.selectedTags)
      }
    },
    computed: {
      tags() {
        return this.$store.state.tags
      },
      soundSymbols(){
        return _.isEmpty(this.selectedSymbols) ? '' : `/ ${this.selectedSymbols.join(' ')} /`
      },
      keyboardStyle(){
        return this.addSymbol ? 'has-text-success' : 'has-text-black'
      }
    }
  }

</script>
<style scoped>
  ::placeholder {
    color: #8795a1;
  }
  .add-sound{
    margin: 1rem 0;
  }
  .optional{
    border-bottom: #eff0f1 solid 3px;
    margin: 1rem 0;
    font-size: 1.2rem;
    font-weight: bold;
  }
  .symbol_input{
    display: flex;
    align-items: center;
  }
  .symbol_input__keyboard{
    font-size: 1.7rem;
  }
</style>