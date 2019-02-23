<template>
  <main>
    <h1>404 - Page Not Found</h1>
    <p>{{ message }}</p>
    <button @click="$router.go(-1)">Go Back</button>
    <button @click="$router.replace('/')">Go Home</button>
  </main>
</template>

<script>
export default {
  data() {
    return {
      message: 'Apparently nothing exists at this location.'
    }
  },
  created() {
    this.$store.dispatch('updateDocTitle', { parts: [ 'Page not found', this.$store.state.site.name ] })
  }
}
</script>
