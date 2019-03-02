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
  name: 'CategoryArchive',
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
      required: true
    },
  },
  data () {
    return {
      postsRequest: {
        type: 'posts',
        params: {
          per_page: this.$store.state.site.posts_per_page,
          page: this.page,
          categories: null
        },
        showLoading: true
      },
      categoryRequest: {
        type: 'categories',
        slug: this.slug
      },
      totalPages: 0
    }
  },
  computed: {
    category() {
      return this.$store.getters.singleBySlug(this.categoryRequest)
    },
    posts() {
      if (this.category) {
        return this.$store.getters.requestedItems(this.postsRequest)
      }
    },
    title() {
      return `Archive for ${this.category ? this.category.name : ''}`
    }
  },
  methods: {
    getCategory() {
      return this.$store.dispatch('getSingleBySlug', this.categoryRequest).then(() => {
        this.setPostsRequestParams()
        this.$store.dispatch('updateDocTitle', { parts: [ this.category.name, this.$store.state.site.name ] })
      })
    },
    getPosts() {
      return this.$store.dispatch('getItems', this.postsRequest)
    },
    setPostsRequestParams() {
      this.postsRequest.params.categories = this.category.id
    },
    setTotalPages() {
      this.totalPages = this.$store.getters.totalPages(this.postsRequest)
    }
  },
  created() {
    this.getCategory().then(() => this.getPosts()).then(() => this.setTotalPages())
  }
}
</script>
