<template>
  <div class="details__descriptions">
    <div v-for="description in descriptions" class="details__description" :id="description.id">
      <div class="description__owner">
        <router-link to="#">
          <img :src="description.user.avatar" alt="">
        </router-link>
        <router-link :to="`/user/${description.user.username}`" class="description__owner--username">{{description.user.username}}</router-link>
        <div class="description__owner-info">
          <span class="description__owner-info--count tag is-white" title="Total number of words authored">
            <span class=""><i class="fa fa-file-word-o mr-4"></i></span>
            <span :key="likesKey">{{description.user.words_count}}</span>
          </span>
          <span class="tag description__owner-info--count is-link" title="Total number of descriptions added">
            <span class=""><i class="fa fa-comments-o mr-4"></i></span>
            <router-link :to="`/user/${description.user.username}#descriptions`" class="has-text-primary">{{description.user.descriptions_count}}</router-link>
          </span>
        </div>
      </div>
      <div class="description__details">
        <div class="description__icons">
          <div>
            <span v-if="description.symbol">{{description.symbol.body}}</span>
            <template v-else></template>
          </div>
          <a v-if="description.audio_file" id="audio-click-link" title="Listen to Pronounciation" class=""><i class="fa fa-volume-up mr-4 has-text-info"></i>Listen to pronounciation
            <audio :src="description.audio_file.url"></audio>
          </a>
        </div>
        <div class="description__texts" >
          <span class="title">{{description.id}}</span>
          <h3>{{description.body}}</h3>
        </div>
        <div class="description__footer">
          <span>Added {{description.date_created}}</span>
          <div>
            <DescriptionLikes :description="description"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import DescriptionLikes from "./DescriptionLikes";

  export default {
    components:{
      DescriptionLikes
    },
    mounted(){
      if(this.$route.hash){
        window.history.pushState('','',`/#/details/${this.word.slug}`)
        let id = this.$route.hash.substr(1)
        let descriptionEl = document.getElementById(id)
        descriptionEl.scrollIntoView({inline: "nearest"})
      }
      this.setupDescriptionTexts()
      this.setupAudio()
    },
    data() {
      return {
        likesKey: 0,
        expanded: false
      }
    },
    methods: {
      updateLikesCount(){
        this.likesKey +=1
      },
      setupDescriptionTexts(){
        let descriptions = document.querySelectorAll('.description__texts h3')
        descriptions.forEach((description)=>{
          let text = description.textContent
          if(text.length > 300){
            let expansion = document.createElement('a')
            expansion.classList.add('description__toggle-expansion')
            expansion.innerHTML = "Expand to view more..."
            description.textContent =   _.truncate(text,{'length': 300})
            description.appendChild(expansion)
            expansion.addEventListener('click',()=>{
              expansion.classList.toggle('description__toggle-expansion--shrink')
              if(!this.expanded){
                description.textContent = text
                expansion.innerHTML = "Click to shrink..."
                description.appendChild(expansion)
              }else{
                description.textContent = _.truncate(text,{'length': 300})
                expansion.innerHTML = "Expand to view more..."
                description.appendChild(expansion)
              }
              this.expanded = !this.expanded
            })
          }
        })
      },
      setupAudio(){
        let audioClickLinks = document.querySelectorAll('#audio-click-link')
        audioClickLinks.forEach(link=>{
          link.addEventListener('click',playSound)
        })
        function playSound(e){
          let audio = this.querySelector('audio')
          audio.play()
        }
      },
    },
    watch:{
      descriptions: function(){
        this.updateLikesCount
      }
    },
    computed: {
      word(){
        return this.$store.state.wordDetail
      },
      descriptions() {
        return this.$store.state.wordDetail.descriptions
      },
    }
  }

</script>

<style>

</style>