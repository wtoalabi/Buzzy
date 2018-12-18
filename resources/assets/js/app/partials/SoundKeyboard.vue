<template>
  <div class="keyboard">
    <div class="symbol_input">
      <input id="symbol" type="text" class="input" placeholder="e.g CPU = /siːpiːˈjuː/" v-model="renderedSymbols" disabled/>
      <a class="fa fa-keyboard-o ml-10 symbol_input__keyboard" :class="keyboardStyle" @click="toggleKeyboard" title="Open Phonetics Keyboard"></a>
    </div>
    <ul class="keyboard__list hide">
      <li v-for="sound in sounds" class="keyboard__item" :data-ipa="sound.ipa">
        {{sound.ipa}}
      </li>
      <em>Copied from: 'http://www.antimoon.com/how/pronunc-soundsipa.htm'</em>
    </ul>
    <div class="rendered-sound">
      <span v-if="showControl" class="controls rendered-sound__controls">
        <a class="mr-6" title="Remove last symbol" @click="removeLastSymbol"><i class="fa fa-arrow-left has-text-danger rendered-sound__controls--icons"></i></a>
        <a title="Submit symbols" @click="closeKeyboard"><i class="fa fa-check has-text-success rendered-sound__controls--icons"></i></a>
      </span>
    </div>
  </div>
</template>

<script>
  import sounds from "../globals/sounds";
  export default {
    mounted(){
      this.arrangeSymbolKeys()
    },
    data() {
      return {
        control:false,
        sounds: sounds,
        addSymbol: false,
        selectedSymbols: []
      }
    },
    methods: {
      addSymbols(symbol){
          this.selectedSymbols.push(symbol)
      },
      removeLastSymbol(){
        this.selectedSymbols.pop()
      },
      closeKeyboard(){
        this.toggleKeyboard()
      },
      findSound(el){
        return sounds.find((sound)=>{
          return sound.ipa === el.dataset.ipa;
        })
      },
      toggleKeyboard(){
        let keyboard = document.querySelector('.keyboard__list')
        keyboard.classList.toggle('hide')
        this.control = !keyboard.classList.contains('hide');
      },
      arrangeSymbolKeys(){
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
            this.addSymbols(soundEl.dataset.ipa)
          })
        })
      }
    },
    computed: {
      showControl(){
        if(!_.isEmpty(this.selectedSymbols) && this.control){
          return true
        }else{
          return false;
        }
      },
      renderedSymbols(){
        let symbols = _.isEmpty(this.selectedSymbols) ? '' : `/ ${this.selectedSymbols.join(' ')} /`
        this.$store.commit('phoneticSymbols', symbols)
        return symbols;
      },
      keyboardStyle(){
        return this.control ? 'has-text-success' : 'has-text-black'
      },
    }
  }

</script>
<style scoped>
  .rendered-sound__controls--icons{
    font-size: 1.5rem;
  }
</style>