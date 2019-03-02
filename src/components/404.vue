<template>
  <main>
    <h1>{{ title }}</h1>
    <p>{{ message }}</p>
  </main>
</template>

<script>
export default {
  data() {
    return {
      title: '404 - Page Not Found',
      message: 'Apparently nothing exists at this location.'
    }
  },
  created() {
    this.$store.dispatch('updateDocTitle', { parts: [ 'Page not found', this.$store.state.site.name ] })
  }
}
</script>
