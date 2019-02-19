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
      return { type: 'pages', slug: this.slug }
    }
  },
  methods: {
    getPage () {
      this.$store.dispatch('getSingleBySlug', this.request).then(() => {
        if (!this.page) this.$router.replace('/404')
      })
    }
  },
  watch: {
    '$route': 'getPage'
  },
  created () {
    this.getPage()
  }
}
</script>
