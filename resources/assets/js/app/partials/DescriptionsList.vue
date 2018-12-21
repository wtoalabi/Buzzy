<template>
  <div class="details__descriptions">
    <div v-for="description in descriptions" class="details__description">
      <div class="description__owner">
        <router-link to="#">
          <img :src="description.user.avatar" alt="">
        </router-link>
        <router-link to="#" class="description__owner--username">{{description.user.username}}</router-link>
        <div class="description__owner-info">
          <span class="description__owner-info--count tag is-white" title="Total number of words authored">
            <span class=""><i class="fa fa-file-word-o mr-4"></i></span>
            <span>{{description.user.words_count}}</span>
          </span>
          <span class="tag description__owner-info--count is-link" title="Total number of descriptions added">
            <span class=""><i class="fa fa-comments-o mr-4"></i></span>
            <span>{{description.user.descriptions_count}}</span>
          </span>
        </div>
      </div>
      <div class="description__details">
        <div class="description__icons">
          <code v-if="description.symbol">{{description.symbol.body}}</code>
          <a v-if="description.audio_file" title="Listen to Pronounciation" class=""><i class="fa fa-volume-up mr-4 has-text-info"></i>Listen to pronounciation</a>
        </div>
        <div class="description__texts">
          <h3>{{description.body}}</h3>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    mounted(){
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
    data() {
      return {
        expanded: false
      }
    },
    methods: {},
    computed: {
      descriptions() {
        return this.$store.state.wordDetail.descriptions
      }
    }
  }

</script>

<style>
  .details__descriptions {
    padding: 1rem;
    margin: 0 0 1rem 0;
  }
  .details__description {
    border-radius: 0 0 1rem 1rem;
    padding: 1rem;
    background: #3da9f90a;
    margin-bottom: 1rem;
    box-shadow: 0 0 0.3rem 0 #607D8B;
    display: flex;
    justify-content: space-around;
    align-items: center;
  }
  .details__description:nth-child(odd) {
    border-radius: 1rem 1rem 0 0;
  }
  .description__owner{
    margin-right: 2rem;
    flex-basis: 15%;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .description__owner a{
    display: flex;
    flex-direction: column;
  }
  .description__owner img{
    width: 4rem;
    border-radius: 50%;
    margin-bottom: 1rem;
  }
  .description__owner--username{
    margin: .51rem 0;
  }
  .description__details{
    flex: 2;
  }
  .description__icons{
    display: inline-flex;
    justify-content: space-between;
    flex-direction: column;
  }
  .description__icons code{
    background-color: #ffdd57;
    color: #091d31;
    font-size: 1.1rem;
    padding: .3rem;
    font-weight: 700;
  }
  .description__texts{
    padding: .5rem 1rem;
  }
  .description__owner-info{
    display: flex;
    //flex-direction: column;
  }
  .description__owner-info > span{
    margin-right: .4rem;
  }
  span.description__owner-info--count{
    display: flex;
    justify-content: space-between;
  }
  .description__texts{
    display: flex;
    flex-direction: column;
  }
  .description__toggle-expansion{
    padding: .41rem;
    background-color: #f6fcfff0;
    color: #0b2339;
    width: auto;
    display: flex;
    justify-content: center;
    font-weight: bold;
    margin-top: -1.3rem;
    box-shadow: 0px 0px 7px 0px white;
    border-radius: 1rem;
  }
  .description__toggle-expansion--shrink{
    margin-top: 0;
    box-shadow: none;
    border-radius: 0;
  }
  @media screen and (max-width: 350px){
    .description__icons code{
      font-size: .65rem;
    }
  }
  @media screen and (max-width: 500px){
    .details__description{
      flex-direction: column-reverse;
    }
    .details__description .description__owner{
      width: 3rem;
    }
  }
  @media screen and (min-width: 750px){
    .description__icons{
      flex-direction: row;
      display: flex;
    }
    .description__owner{
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .description__owner img{
      margin-bottom: 0;
    }
    .description__owner--username{
      margin: 0;
    }
  }
</style>