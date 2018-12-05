<template>
  <main>
    <div class="wrapper">
      <header>
        <nav>
          <ul>
            <li>Home</li>
            <li>About</li>
          </ul>
        </nav>
      </header>
      <section>
        <p style="font-size: 50px; margin-top: 40px">The Home Page For MDS ONE As A Whole</p>
        <p style="font-size: 50px; margin-top: 40px">The Home Page For MDS ONE As A Whole</p>
        <p style="font-size: 50px; margin-top: 40px">The Home Page For MDS ONE As A Whole</p>
        <p style="font-size: 50px; margin-top: 40px">The Home Page For MDS ONE As A Whole</p>
        <p style="font-size: 50px; margin-top: 40px">The Home Page For MDS ONE As A Whole</p>
        <p style="font-size: 50px; margin-top: 40px">The Home Page For MDS ONE As A Whole</p>
      </section>
    </div>
    <footer>
      Footer
    </footer>
  </main>
</template>

<script>
  import Navbar from "./partials/Navbar";
  import Footer from "./partials/Footer";

  export default {
    mounted() {
      this.$store.dispatch('initialLoading')

    },
    components: {Navbar, Footer},
    data() {
      return {}
    },
    methods: {},
    computed: {
      loaded() {
        return !_.isEmpty(this.$store.state.content);
      }
    }
  }
</script>
<style>
  html, body, main, #buzz {
    height: 100%;
    margin: 0;
    padding: 0;
  }
  main{
    display: flex;
    flex-direction: column;
  }
  .wrapper{
    flex: 1;
  }
  header,footer{
    background-color: chocolate;
    height: 4rem;
  }
  header{
    position: fixed;
    width: 100%;
  }
  header nav ul{
    display: flex;
    justify-content: space-around;
  }
  section{
    margin-top: 60px;
  }
  footer{
    padding: 1rem;
  }
</style>