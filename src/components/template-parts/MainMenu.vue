<template>
  <nav class="main-menu">
    <a
      v-for="item in menu"
      :key="item.id"
      :href="item.url"
      :target="item.target"
      :title="item.title"
      v-html="item.content"
    ></a>
  </nav>
</template>

<script>
export default {
  data() {
    return {}
  },
  computed: {
    menu() {
      return this.$store.getters.menu({ name: 'main' })
    }
  }
}
</script>
