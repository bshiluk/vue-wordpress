<template>
  <main>
    <section v-if="posts">
      <article
        v-for="post in posts"
        :key="post.id"
      >
        <h2>
          <a 
            :href="post.link"
            :title="post.title.rendered"
            v-html="post.title.rendered"
          ></a>
        </h2>
        <div v-html="post.excerpt.rendered"></div>
      </article>
    </section>
  </main>
</template>

<script>
export default {
  name: 'Home',
  props: {
    page: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      per_page: this.$store.state.site.posts_per_page,
      totalPages: 0
    }
  },
  computed: {
    request() {
      return { type: 'posts', params: { per_page: this.per_page, page: this.page } }
    },
    posts() {
      return this.$store.getters.requestedItems(this.request)
    }
  },
  methods: {
    getPosts() {
      return this.$store.dispatch('getItems', this.request)
    },
    setTotalPages() {
      this.totalPages = this.$store.getters.totalPages(this.request)
    }
  },
  watch: {
    '$route.params.page': 'getPosts'
  },
  created() {
    this.getPosts().then(() => this.setTotalPages())
  }
}
</script>
