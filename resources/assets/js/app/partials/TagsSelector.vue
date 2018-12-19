<template>
  <div>
    <div class="control">
      <input id="tags" autofocus autocomplete="off" name="tags" class="input" type="text" :placeholder="tagPlaceholder"
             @input="pickTag">
    </div>
    <ul class="filtered-tags-list">
      <li v-for="each in filteredTags" class="filtered-tags-each" @click="clickedTag(each.id)">
        <span class="">{{each.tag}}</span>
      </li>
    </ul>
    <span v-if="noTagFound" class="no-tag-found has-text-danger">No matching tag found...click <u @click="suggestTag"
                                                                                                  class="no-tag-found__pick">here</u> to suggest it. </span>
    <div class="selected-tags">
    <span v-for="each in selectedTags" class="tag selected-tags__each"
          @click="removeTag(each)">{{each.tag}}</span>
      <span v-if="suggestedTags.length > 0" v-for="each in suggestedTags" class="tag is-warning"
          @click="removeTag(each)">{{each}}</span>
    </div>

  </div>
</template>

<script>
  let tagsCount = 5;
  export default {
    mounted() {
      this.tagInputEl = document.querySelector('input#tags')
    },
    data() {
      return {
        filteredTags: '',
        selectedTags: [],
        tagPlaceholder: `Type up to ${tagsCount} related tags`,
        typedValue: '',
        tagInputEl: '',
        noTag: '',
        suggestedTags: []
      }
    },
    methods: {
      pickTag(e) {
        this.typedValue = e.target.value.toLowerCase()
        if (this.typedValue) {
          this.filteredTags = this.tags.filter((each) => {
            if (!this.selectedTags.includes(each)) {
              return each.tag.toLowerCase().includes(this.typedValue)
            }
          })
          this.checkTagAvailability()
        } else {
          this.filteredTags = ''
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
      suggestTag() {
        this.tagInputEl.focus()
        this.tagInputEl.value = ''
        this.noTag = false
        this.suggestedTags.push(this.typedValue)
      },
      checkTagAvailability() {
        let count = this.tags.filter((tag) => {
          return tag.tag.includes(this.typedValue)
        })
        this.noTag = count.length === 0;
      },
      calculateRemainingTags() {
        let count = this.selectedTags.length;
        if (count === 0) {
          this.tagPlaceholder = `Type up to ${tagsCount} related tags`;
        } else if (count === tagsCount) {
          this.tagPlaceholder = 'Maxed out...You cant add more...';
        } else if (count <= tagsCount) {
          this.tagPlaceholder = `${tagsCount - count} more...`
        }
        this.$store.commit('selectedTags', this.selectedTags.map(d => d.id))
        this.$store.commit('suggestedTags', this.suggestedTags)
      },
    },
    computed: {
      tags() {
        return this.$store.state.tags
      },
      noTagFound() {
        return this.noTag
      }
    }
  }

</script>

<style>
  .no-tag-found__pick {
    cursor: pointer;
  }
</style>