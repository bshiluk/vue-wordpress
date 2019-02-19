<template>
  <main>
    <article v-if="post">
      <h1 v-html="post.title.rendered"></h1>
      <div v-html="post.content.rendered"></div>
    </article>
  </main>
</template>

<script>
export default {
  name: 'Single',
  props: {
    slug: {
      type: String,
      required: false
    }
  },
  data() {
    return {}
  },
  computed: {
    post() {
      return this.$store.getters.singleBySlug(this.request)
    },
    request() {
      return { type: 'posts', slug: this.slug }
    }
  },
  methods: {
    getPost() {
       this.$store.dispatch('getSingleBySlug', this.request)
    }
  },
  watch: {
    '$route': 'getPost'
  },
  created() {
    this.getPost()
  }
}
</script>
