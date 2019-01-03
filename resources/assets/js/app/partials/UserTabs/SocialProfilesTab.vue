<template>
  <div>
    <form action="" v-if="sameUser">
      <div class="field column">
        <label class="label" for="network-facebook">Facebook</label>
        <div class="control input-section">
          <input id="network-facebook" class="input" name="facebook" type="text" :placeholder="profiles.facebook"
                 autocomplete="off" v-model="networks.facebook" @input="showCheckmark('facebook')">
          <i title="Click to submit" class="fa fa-check" v-if="inputIs('facebook')" @click="submit('facebook')"></i>
          <i class="fa fa-refresh fa-spin" v-if="sending === 'facebook'"></i>
        </div>
        <i v-if="profiles.facebook"><a :href="`http://www.facebook.com/${profiles.facebook}`" target="_blank">http://www.facebook.com/{{profiles.facebook}}</a></i>
      </div>
      <div class="field column">
        <label class="label" for="network-twitter">Twitter</label>
        <div class="control input-section">
          <input id="network-twitter" class="input" name="twitter" type="text" :placeholder="profiles.twitter"
                 autocomplete="off" v-model="networks.twitter" @input="showCheckmark('twitter')">
          <i title="Click to submit" class="fa fa-check" v-if="inputIs('twitter')" @click="submit('twitter')"></i>
          <i class="fa fa-refresh fa-spin" v-if="sending === 'twitter'"></i>
        </div>
        <i v-if="profiles.twitter"><a :href="`http://www.twitter.com/${profiles.twitter}`" target="_blank">http://www.twitter.com/{{profiles.twitter}}</a></i>
      </div>
      <div class="field column">
        <label class="label" for="network-github">Guthub</label>
        <div class="control input-section">
          <input id="network-github" class="input" name="github" type="text" :placeholder="profiles.github"
                 autocomplete="off" v-model="networks.github" @input="showCheckmark('github')">
          <i title="Click to submit" class="fa fa-check" v-if="inputIs('github')" @click="submit('github')"></i>
          <i class="fa fa-refresh fa-spin" v-if="sending === 'github'"></i>
        </div>
        <i v-if="profiles.github"><a :href="`http://www.github.com/${profiles.github}`" target="_blank">http://www.github.com/{{profiles.github}}</a></i>
      </div>
    </form>
    <div v-else class="profiles">
      <h1 class="profiles__title">User Social Profiles</h1>
      <div v-if="profiles.facebook" class="profiles__networks">
        <span>Facebook: </span><a :href="`http://www.facebook.com/${profiles.facebook}`" target="_blank"><i
          class="fa fa-facebook-official facebook"></i></a>
      </div>
      <div v-if="profiles.twitter" class="profiles__networks">
        <span>Twitter: </span><a :href="`http://www.twiiter.com/${profiles.twitter}`" target="_blank"><i
          class="fa  fa-twitter twitter"></i></a>
      </div>
      <div v-if="profiles.github" class="profiles__networks">
        <span>Github: </span> <a :href="`http://www.github.com/${profiles.github}`" target="_blank"><i class="fa fa-github-square github"></i></a>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    mounted() {
    },
    data() {
      return {
        sending: false,
        input: '',
        networks: {}
      }
    },
    methods: {
      submit(network) {
        this.sending = network;
        this.input = ''
        axios.post(`api/save-social-profile/${network}`, {username: this.networks[network]}).then(response => {
          this.sending = ''
          this.$store.commit('message','Successfully Saved')
          this.$store.commit('userSocialProfile', response.data)
        }).catch(error => {
          this.sending = ''
        })
      },
      inputIs(network) {
        return this.input === network
      },
      showCheckmark(network) {
        this.input = network
      }
    },
    computed: {
      profiles() {
        return this.$store.state.userDetails.social_profiles
      },
      sameUser() {
        if (this.$store.state.loggedInUser) {
          return this.$store.state.loggedInUser.id === this.$store.state.userDetails.user.id
        }
      }
    }
  }

</script>

<style scoped lang="scss">
  .input-section {
    display: flex;
    justify-content: space-between;
    align-items: center;

    input {
    }

    i {
      margin-left: .3rem;
      color: #87da87;
      font-size: 1.5rem;
      cursor: pointer;
    }
  }
  .input-section ~ i > a{
      word-break: break-all;
  }

  .profiles {
    .profiles__title {
      font-size: 2rem;
    }

    .profiles__networks {
      font-size: 1.5rem;
    }

    .twitter {
      color: #1b95e0;
    }

    .facebook {
      color: #4267b2;
    }

    .github {
      color: #ce9178;
    }
  }
</style>