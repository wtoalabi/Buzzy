<template>
  <div class="home-list" :style="listStyles">
    <PopularList />
    <RecentList />
    <TrendingList />
  </div>
</template>

<script>
  import PopularList from "./Lists/PopularList";
  import RecentList from "./Lists/RecentList";
  import TrendingList from "./Lists/TrendingList";
  export default {
    components:{
      PopularList,RecentList,TrendingList
    },
    mounted(){
      this.getSearchBoxRect();
      window.addEventListener('resize',this.getSearchBoxRect);
    },
    data() {
      return {
        listStyles: {},
      }
    },
    methods: {
      getSearchBoxRect() {
        const searchContainer = document.querySelector('.search-container')
        const htmlView = document.querySelector('html');
        const htmlRect = htmlView.getBoundingClientRect()
        const searchRect = searchContainer.getBoundingClientRect()
        const offsetLeft = ((htmlRect.width - searchRect.width)/2)-8
        return this.listStyles = {marginTop: searchRect.top, width: searchRect.width, marginLeft: offsetLeft}
      }
    },
    computed: {}
  }

</script>
