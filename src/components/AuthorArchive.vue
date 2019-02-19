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
  name: 'AuthorArchive',
  props: {
    page: {
      type: Number,
      required: true
    },
    slug: {
      type: String,
      required: false
    }
  },
  data () {
    return {
      per_page: this.$store.state.site.posts_per_page,
      totalPages: 0
    }
  },
  computed: {
    author() {
      return this.$store.getters.singleBySlug(this.authorRequest)
    },
    authorRequest() {
      return { type: 'users', slug: this.slug }
    },
    posts() {
      if (this.postsRequest) {
        return this.$store.getters.requestedItems(this.postsRequest)
      } else {
        return Array.from({ length: this.per_page }).map((v,i) => ({ id: `loading${i}` }))
      }
    },
    postsRequest() {
      if (this.author){
        return { type: 'posts', params: { per_page: this.per_page, page: this.page, author: this.author.id } }
      }
    },
    title() {
      return `Posts by ${this.author ? this.author.name : '______ ________'}`
    }
  },
  methods: {
    getAuthor() {
      return this.$store.dispatch('getSingleBySlug', this.authorRequest)
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
        this.getAuthor().then(() => this.getPosts()).then(() => this.setTotalPages())
      } else if (a.params.page !== b.params.page){
        this.getPosts()
      }
    }
  },
  created() {
    this.getAuthor().then(() => this.getPosts()).then(() => this.setTotalPages())
  }
}
</script>
