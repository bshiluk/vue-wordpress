<template>
  <nav>
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
  name: 'NavMenu',
  props: {
    name: {
      type: String,
      required: true
    }
  },
  data() {
    return {}
  },
  computed: {
    menu() {
      return this.$store.getters.menu({ name: this.name })
    }
  }
}
</script>
