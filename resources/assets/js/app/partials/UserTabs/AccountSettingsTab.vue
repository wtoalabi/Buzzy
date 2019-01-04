<template>
  <div>
    <h1 class="tab-title">Your Account</h1>
    <loading v-if="loading"/>
    <form>
      <div class="columns">
        <div class="field column">
          <label class="label" for="full_name">Full Name</label>
          <div class="control">
            <input id="full_name" class="input" name="full_name" type="text" placeholder="" autocomplete="off"
                   v-model="form.full_name">
            <h1 class="has-text-grey-dark">This is optional. Using only your username is pretty fine.</h1>
            <div v-if="errors.full_name" class="has-text-danger">{{errors.full_name[0]}}</div>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="field column">
          <label class="label" for="username">Username</label>
          <div class="control">
            <input id="username" class="input" name="username" type="text" placeholder="" autocomplete="off"
                   v-model="form.username">
            <h1 class="has-text-grey-dark" v-if="!user.changed_username">This looks ugly. Change it to something
                  nice and cute.</h1>
            <div v-if="errors.username" class="has-text-danger">{{errors.username[0]}}</div>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="field column">
          <div class="control">
            <div class="avatar-preview">
              <img :src="form.avatar" alt="">
              <button v-if="hasAvatar" @click="removeAvatar" class="button is-danger is-small mb-10">Remove Avatar
              </button>
            </div>
            <FileUploads type="image" maxSize="200" variant="avatar"/>
            <h1 class="has-text-grey-dark avatar-info--text">Click the upload icon to upload newer avatar.</h1>
          </div>
        </div>
      </div>
      <div class="submit__buttons">
        <div class="">
          <button class="button is-warning" type="submit" @click="submit">Submit</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
  import FileUploads from "../Uploads/FileUploads";
  import avatarUpload from '../../globals/mixins/avatarUpload'

  export default {
    mixins: [avatarUpload],
    components: {FileUploads},
    mounted() {
      this.form = Object.assign({}, this.user)
    },
    data() {
      return {
        form: {},
        newForm: {
          full_name: '',
          username: ''
        }
      }
    },
    methods: {
      submit(e) {
        e.preventDefault()
        this.$store.commit('fetching')
        this.newForm.full_name = this.form.full_name
        this.newForm.username = this.form.username
        return axios.post('api/save-user-details', this.newForm).then(response => {
          this.$store.commit('loaded')
          this.$store.commit('updateUserAccount', response.data.data)
        }).catch(error => {
          this.$store.commit('loaded')
          this.$store.commit('formErrors', error.response.data.errors);
          this.$store.commit('serverError',error)
        })
      }
    },
    computed: {
      user() {
        return this.$store.state.userDetails.user
      },
      errors() {
        return this.$store.state.formErrors;
      },
      hasAvatar() {
        return !this.user.avatar.includes('default.png')
      },
      loading(){
        return this.$store.loaded
      }
    }
  }

</script>
<style scoped lang="scss">
  ::placeholder {
    color: #607d8b !important;
  }

  :disabled {
    background-color: #9e9e9e38 !important;
  }

  .avatar-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .avatar-preview {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;

    img {
      margin-bottom: .5rem;
      border-radius: 50%;
      height: 4rem;
      width: 4rem;
    }
  }


  .file-upload__custom-icon {
    font-size: 2rem;
  }

  .avatar-info--text {
    text-align: center;
  }
</style>