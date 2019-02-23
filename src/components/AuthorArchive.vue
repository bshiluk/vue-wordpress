<template>
  <main>
    <header>
      <h1>{{ title }}</h1>
    </header>
    <section v-if="posts">
      <post-item
        v-for="post in posts"
        :key="post.id"
        :post="post"
      />
      <pagination
        v-if="totalPages > 1"
        :total="totalPages"
        :current="page"
      />
    </section>
  </main>
</template>

<script>
import PostItem from '@/components/template-parts/PostItem'
import Pagination from '@/components/template-parts/Pagination'

export default {
  name: 'AuthorArchive',
  components: {
    PostItem,
    Pagination
  },
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
      }
    },
    postsRequest() {
      if (this.author){
        return { type: 'posts', params: { per_page: this.per_page, page: this.page, author: this.author.id }, showLoading: true }
      }
    },
    title() {
      return `Posts by ${this.author ? this.author.name : ''}`
    }
  },
  methods: {
    getAuthor() {
      return this.$store.dispatch('getSingleBySlug', this.authorRequest).then(() => {
        this.$store.dispatch('updateDocTitle', { parts: [ this.author.name, this.$store.state.site.name ] })
      })
    },
    getPosts() {
      return this.$store.dispatch('getItems', this.postsRequest)
    },
    setTotalPages() {
      this.totalPages = this.$store.getters.totalPages(this.postsRequest)
    }
  },
  created() {
    this.getAuthor().then(() => this.getPosts()).then(() => this.setTotalPages())
  }
}
</script>
