<template>
  <div class="details-container">
    <div class="tab-links">
      <div id="words" class="tab-link" :class="defaultTab" @click="isActive">Words</div>
      <template v-if="sameUser">
        <div id="account-settings" class="tab-link" @click="isActive">Account Settings</div>
        <div id="bookmarks" class="tab-link" @click="isActive">Bookmarks</div>
        <!--<div id="history" class="tab-link" @click="isActive">History</div>-->
      </template>
      <div id="social-profiles" class="tab-link" @click="isActive">Social Profiles</div>
    </div>
    <div class="canvas">
      <WordsTab v-if="activeTab === 'words'"/>
      <AccountSettingsTab v-if="activeTab === 'account-settings'"/>
      <BookmarksTab v-if="activeTab === 'bookmarks'"/>
      <!--<HistoryTab v-if="activeTab === 'history'"/>-->
      <SocialProfilesTab  v-if="activeTab === 'social-profiles'"/>
    </div>
  </div>
</template>

<script>
  import WordsTab from "./WordsTab";
  import AccountSettingsTab from "./AccountSettingsTab";
  import HistoryTab from "./HistoryTab";
  import SocialProfilesTab from "./SocialProfilesTab";
  import BookmarksTab from "./BookmarksTab";

  export default {
    components:{
      WordsTab,AccountSettingsTab, BookmarksTab, HistoryTab,SocialProfilesTab,
    },
    data() {
      return {
        prevTab: '',
        activeTab: 'words'
      }
    },
    methods: {
      isActive(e){
        let current = e.target
        current.classList.add('active-tab')
        this.activeTab = current.id
        if(this.prevTab){
          this.prevTab.classList.remove('active-tab')
        }
        this.prevTab = e.target
      }
    },
    computed: {
      sameUser(){
        if(!_.isEmpty(this.$store.state.loggedInUser)) {
          return this.$store.state.loggedInUser.id === this.$store.state.userDetails.user.id
        }
      },
      defaultTab(){
        if(this.activeTab ==='words'){
          return 'active-tab'
        }
      }
    }
  }

</script>

<style lang="scss">
  /*TODO Remove the tabs line*/
  @import "../../../../sass/custom/components/tabs";
  .tab-title{
    font-size: 1rem;
    font-weight: bold;
    @include media(700px){
      font-size: 1.2rem;
    }
  }
</style>