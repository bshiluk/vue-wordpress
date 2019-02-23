<template>
  <main>
    <div v-if="page">
      <h1 v-html="page.title.rendered"></h1>
      <div v-html="page.content.rendered"></div>
    </div>
  </main>
</template>

<script>

export default {
  name: 'Page',
  props: {
    slug: {
      type: String,
      required: true
    }
  },
  data() {
    return {}
  },
  computed: {
    page() {
      return this.$store.getters.singleBySlug(this.request)
    },
    request() {
      return { type: 'pages', slug: this.slug, showLoading: true }
    }
  },
  methods: {
    getPage () {
      this.$store.dispatch('getSingleBySlug', this.request).then(() => {
        if (this.page) {
          this.$store.dispatch('updateDocTitle', { parts: [ this.page.title.rendered, this.$store.state.site.name] })
        } else {
          this.$router.replace('/404')
        }
      })
    }
  },
  created () {
    this.getPage()
  }
}
</script>
