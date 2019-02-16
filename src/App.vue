<template>
  <div id="vue-wordpress-app">
    <h1></h1>
    <p>{{ description }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: 'Vue.wordpress',
      description: 'A Wordpress starter theme with a Vue.js frontend.'
    }
  },
  mounted() {
    console.log('App Mounted')
  }
}
</script>

<style>

html {
font-size: 62.5%;
}

body {
  margin: 0;
  font-size: 1.8em;
  line-height: 1.6;
  font-weight: 400;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu,Cantarell, "Helvetica Neue", sans-serif;
  color: #444; 
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

</style>
