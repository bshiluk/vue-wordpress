<template>
  <main>
    <header>
      <h1>{{ title }}</h1>
    </header>
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
  name: 'TaxonomyArchive',
  props: {
    type: {
      type: String,
      required: true
    },
    page: {
      type: Number,
      required: true
    },
    slug: {
      type: String,
      required: true
    },
  },
  data () {
    return {
      per_page: this.$store.state.site.posts_per_page,
      totalPages: 0
    }
  },
  computed: {
    taxonomy() {
      return this.$store.getters.singleBySlug(this.taxonomyRequest)
    },
    taxonomyRequest() {
      return { type: this.type, slug: this.slug }
    },
    posts() {
      if (this.postsRequest) {
        return this.$store.getters.requestedItems(this.postsRequest)
      }
    },
    postsRequest() {
      if (this.taxonomy) {
        let request = { type: 'posts', params: { per_page: this.per_page, page: this.page } }
        request.params[this.type] = this.taxonomy.id
        return request
      }
    },
    title() {
      return `Archive for ${this.taxonomy ? this.taxonomy.name : '__________'}`
    }
  },
  methods: {
    getTaxonomy() {
      return this.$store.dispatch('getSingleBySlug', this.taxonomyRequest)
    },
    getPosts() {
      return this.$store.dispatch('getItems', this.postsRequest)
    },
    setTotalPages() {
      this.totalPages = this.$store.getters.totalPages(this.postsRequest)
    }
  },
  watch: {
    '$route': function(a, b) {
      if (a.name !== b.name || a.params.slug !== b.params.slug) {
        this.totalPages = 0
        this.getTaxonomy().then(() => this.getPosts()).then(() => this.setTotalPages())
      } else if (a.params.page !== b.params.page){
        this.getPosts()
      }
    }
  },
  created() {
    this.getTaxonomy().then(() => this.getPosts()).then(() => this.setTotalPages())
  }
}
</script>
