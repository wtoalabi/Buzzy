<template>
  <div>
    <transition name="changeMe" enter-active-class="animated zoomIn" leave-active-class="animated fadeOutUp">
      <div class="announcement_container bottom-right" v-if="announcement">
        <div class="bottom-right announcement text-center">
          <span :class="type.color"> <i class="ion mr-2" :class="type.icon"></i> <h1 v-html="activate()"></h1></span>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>

  export default {
    mounted() {
    },
    methods:{
      activate(){
        setTimeout(()=>{
            return this.message.text=''
          },
          this.message.duration||6000)
        return this.message.text
      },
    },
    computed:{
      message(){
        return this.$store.state.announcement.message
      },
      type(){
        if(this.message.type == 'error'){
          return {color: 'is-error',icon: 'fa fa-exclamation-circle'}
        }
        else if(this.message.type == 'success'){
          return {color: 'is-success',icon: 'fa fa-thumbs-up'}
        }
      },
      announcement(){
        return this.message.text
      }
    }
  }
</script>
<style scoped lang="scss">
  .announcement{
    /*max-width: 400px;
    border-radius: 0.25rem;
    min-height: 38px;
    line-height: 1.1em;
    padding: 15px 20px 15px 20px;
    font-size: 18px;
    font-weight: 400;
    color: #fff;
    box-shadow: 4px 1px 20px 6px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);
    top: 20px;
    clear: both;
    margin-top: 10px;
    position: relative;
    word-break: normal;
    box-sizing: inherit;*/
  }
  .announcement_container{
    position: fixed;
    z-index: 99999;
    span{
      display: flex;
      flex-direction: column;
      align-items: center;
      color: #091d31;
      padding: 1.5rem 1rem;
      box-shadow: 1px 1px 13px 5px white;
      h1{
        text-align: center;
      }
    }
  }
  .bottom-right{
    bottom: 30px;
    left: 15px;
  }
  .is-error{
    background:#ffeb3b;
  }
  .is-success{
    background:#8bc34a;
  }
</style>
