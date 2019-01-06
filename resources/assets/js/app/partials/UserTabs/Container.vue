<template>
  <div class="details-container">
    <div class="tab-links">
      <div id="words" class="tab-link" :class="setActiveTab('words')" @click="isActive">Words</div>
      <template v-if="sameUser">
        <div id="account-settings" class="tab-link" @click="isActive" :class="setActiveTab('account-settings')">Account Settings</div>
        <div id="bookmarks" class="tab-link" @click="isActive" :class="setActiveTab('bookmarks')">Bookmarks</div>
        <div id="descriptions" class="tab-link" @click="isActive" :class="setActiveTab('descriptions')">Descriptions</div>
      </template>
      <div id="social-profiles" class="tab-link" @click="isActive" :class="setActiveTab('social-profiles')">Social Profiles</div>
    </div>
    <div class="canvas">
      <WordsTab v-if="activeTab === 'words'"/>
      <AccountSettingsTab v-if="activeTab === 'account-settings'" @setActiveTab="setActiveTab"/>
      <BookmarksTab v-if="activeTab === 'bookmarks'"/>
      <!--<HistoryTab v-if="activeTab === 'history'"/>-->
      <SocialProfilesTab v-if="activeTab === 'social-profiles'"/>
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
    mounted(){
      this.form = Object.assign({}, this.user)
    },
    components: {
      WordsTab, AccountSettingsTab, BookmarksTab, HistoryTab, SocialProfilesTab,
    },
    data() {
      return {}
    },
    methods: {
      isActive(e) {
        let tabID = e.target.id
        this.$store.commit('setTab', tabID)
        window.history.pushState('','',`/#/user/${this.user.username}#${tabID}`)
      },
      setActiveTab(e) {
        if(this.activeTab === e){
          return 'active-tab'
        }
      }
    },
    computed: {
      user(){
        return this.$store.state.userDetails.user
      },
      sameUser() {
        if (!_.isEmpty(this.$store.state.loggedInUser)) {
          return this.$store.state.loggedInUser.id === this.user.id
        }
      },
      defaultTab() {
        if (this.activeTab === 'words') {
          return 'active-tab'
        }
      },
      activeTab() {
        return this.$store.state.userDetails.activeTab
      }
    }
  }

</script>

<style lang="scss">
  /*TODO Remove the tabs line*/
  @import "../../../../sass/custom/components/tabs";

  .tab-title {
    font-size: 1rem;
    font-weight: bold;
    @include media(700px) {
      font-size: 1.2rem;
    }
  }
</style>