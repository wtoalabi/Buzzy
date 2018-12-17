<template>
  <div class="keyboard">
    <ul class="keyboard__list">
      <li v-for="sound in sounds" class="keyboard__item" :data-ipa="sound.ipa">
        {{sound.ipa}}
      </li>
    </ul>
    <div class="rendered-sound">
      <span v-if="showControl" class="controls rendered-sound__controls">
        <a class="mr-6" title="Remove last symbol" @click="removeLastSymbol"><i class="fa fa-arrow-left has-text-danger"></i></a>
        <a title="Submit symbols" @click="closeKeyboard"><i class="fa fa-check has-text-success"></i></a>
      </span>
    </div>
  </div>
</template>

<script>
  import sounds from "../globals/sounds";
  export default {
    props: ['selectedSymbols'],
    mounted(){
      let soundsArray = document.querySelectorAll('.keyboard__item')
      soundsArray.forEach((sound)=>{
        let soundEl = sound;
          sound.addEventListener('mouseenter', () => {
              let hoveredEl = document.createElement('div')
            let sound = this.findSound(soundEl)
            hoveredEl.innerHTML = `<div><h4>Examples: ${sound.examples}</h4></div>`
            hoveredEl.classList.add('hovering')
            soundEl.appendChild(hoveredEl)
            //Shift the hovered element to the left if it offsets far too right.
            hoveredEl.getBoundingClientRect().x < 0 ? hoveredEl.classList.add('hover-left') : ''
          })
          sound.addEventListener('mouseleave', () => {
            soundEl.innerText = this.findSound(soundEl).ipa
          })
          sound.addEventListener('click', (e) => {
            soundEl.innerText = this.findSound(soundEl).ipa
            this.control = true
            this.$emit('symbolsAdded', soundEl.dataset.ipa)

          })
      })
    },
    data() {
      return {
        control:false,
        sounds: sounds,
      }
    },
    methods: {
      removeLastSymbol(){
        this.$emit('removeLastSymbol')
      },
      closeKeyboard(){
        this.$emit('closeKeyboard')
      },
      findSound(el){
        //console.dir(el)
        return sounds.find((sound)=>{
          return sound.ipa === el.dataset.ipa;
        })
      },
    },
    computed: {
      showControl(){
        if(!_.isEmpty(this.selectedSymbols)){
          return true
        }else{
          return this.control
        }
      }
    }
  }

</script>
<style scoped>


</style>