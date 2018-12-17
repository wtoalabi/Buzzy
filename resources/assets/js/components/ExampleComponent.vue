<template>
  <div>
    <button class="btn btn-primary shadow">Click me!</button>
    <b-navbar sticky="true" toggleable="md" type="dark" variant="info">

      <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

      <b-navbar-brand href="#">NavBar</b-navbar-brand>

      <b-collapse is-nav id="nav_collapse">

        <b-navbar-nav>
          <b-nav-item href="#">Link</b-nav-item>
          <b-nav-item href="#" disabled>Disabled</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">

          <b-nav-form>
            <b-form-input size="sm" class="mr-sm-2" type="text" placeholder="Search"/>
            <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
          </b-nav-form>

          <b-nav-item-dropdown text="Lang" right>
            <b-dropdown-item href="#">EN</b-dropdown-item>
            <b-dropdown-item href="#">ES</b-dropdown-item>
            <b-dropdown-item href="#">RU</b-dropdown-item>
            <b-dropdown-item href="#">FA</b-dropdown-item>
          </b-nav-item-dropdown>

          <b-nav-item-dropdown right>
            <!-- Using button-content slot -->
            <template slot="button-content">
              <em>User</em>
            </template>
            <b-dropdown-item href="#">Profile</b-dropdown-item>
            <b-dropdown-item href="#">Signout</b-dropdown-item>
          </b-nav-item-dropdown>
        </b-navbar-nav>

      </b-collapse>
    </b-navbar>
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">
      <b-form-group id="exampleInputGroup1"
                    label="Email address:"
                    label-for="exampleInput1"
                    description="We'll never share your email with anyone else.">
        <b-form-input id="exampleInput1"
                      type="email"
                      v-model="form.email"
                      required
                      placeholder="Enter email">
        </b-form-input>
      </b-form-group>
      <b-form-group id="exampleInputGroup2"
                    label="Your Name:"
                    label-for="exampleInput2">
        <b-form-input id="exampleInput2"
                      type="text"
                      v-model="form.name"
                      required
                      placeholder="Enter name">
        </b-form-input>
      </b-form-group>
      <b-form-group id="exampleInputGroup3"
                    label="Food:"
                    label-for="exampleInput3">
        <b-form-select id="exampleInput3"
                       :options="foods"
                       required
                       v-model="form.food">
        </b-form-select>
      </b-form-group>
      <b-form-group id="exampleGroup4">
        <b-form-checkbox-group v-model="form.checked" id="exampleChecks">
          <b-form-checkbox value="me">Check me out</b-form-checkbox>
          <b-form-checkbox value="that">Check that out</b-form-checkbox>
        </b-form-checkbox-group>
      </b-form-group>
      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
    <div>
      <b-card title="Card Title"
              img-src="https://picsum.photos/600/300/?image=25"
              img-alt="Image"
              img-top
              tag="article"
              style="max-width: 20rem;"
              class="mb-2 shadow">
        <p class="card-text">
          Some quick example text to build on the card title and make up the bulk of the card's content.
        </p>
        <b-button href="#" variant="primary">Go somewhere</b-button>
      </b-card>
    </div>
    <b-breadcrumb :items="[{text: 'Admin',href: '#'},{text: 'User', href:'#'}]"/>
    <div class="my-3">
      <b-btn v-b-popover.hover="'I am popover content!'" title="Popover Title">
        Hover Me
      </b-btn>
    </div>

    <b-alert show>Default Alert</b-alert>

    <b-alert variant="success" show>Success Alert</b-alert>

    <b-alert variant="danger"
             dismissible
             :show="showDismissibleAlert"
             @dismissed="showDismissibleAlert=false">
      Dismissible Alert!
    </b-alert>

    <b-alert :show="dismissCountDown"
             dismissible
             variant="warning"
             @dismissed="dismissCountDown=0"
             @dismiss-count-down="countDownChanged">
      <p>This alert will dismiss after {{dismissCountDown}} seconds...</p>
      <b-progress variant="warning"
                  :max="dismissSecs"
                  :value="dismissCountDown"
                  height="4px">
      </b-progress>
    </b-alert>

    <b-btn @click="showAlert" variant="info" class="m-1">
      Show alert with count-down timer
    </b-btn>
    <b-btn @click="showDismissibleAlert=true" variant="info" class="m-1">
      Show dismissible alert ({{showDismissibleAlert?'visible':'hidden'}})
    </b-btn>
    <div>
      <!-- Using modifiers -->
      <b-btn v-b-toggle.collapse2 class="m-1">Toggle Collapse</b-btn>

      <!-- Using value -->
      <b-btn v-b-toggle="'collapse2'" class="m-1">Toggle Collapse</b-btn>

      <!-- element to collapse -->
      <b-collapse id="collapse2">
        <b-card>
          I am collapsable content!
        </b-card>
      </b-collapse>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        dismissSecs: 10,
        dismissCountDown: 0,
        showDismissibleAlert: false,
        form: {
          email: '',
          name: '',
          food: null,
          checked: []
        },
        foods: [
          { text: 'Select One', value: null },
          'Carrots', 'Beans', 'Tomatoes', 'Corn'
        ],
        showControl: true
      }
    },
    methods: {
      onSubmit (evt) {
        evt.preventDefault();
        alert(JSON.stringify(this.form));
      },
      onReset (evt) {
        evt.preventDefault();
        /* Reset our form values */
        this.form.email = '';
        this.form.name = '';
        this.form.food = null;
        this.form.checked = [];
        /* Trick to reset/clear native browser form validation state */
        this.show = false;
        this.$nextTick(() => { this.show = true });
      },
      countDownChanged (dismissCountDown) {
        this.dismissCountDown = dismissCountDown
      },
      showAlert () {
        this.dismissCountDown = this.dismissSecs
      }
    }
  }
</script>