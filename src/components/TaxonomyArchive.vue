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
  name: 'TaxonomyArchive',
  components: {
    PostItem,
    Pagination
  },
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
      postsRequest: {
        type: 'posts',
        params: {
          per_page: this.$store.state.site.posts_per_page,
          page: this.page,
          categories: null,
          tags: null
        },
        showLoading: true
      },
      taxonomyRequest: {
        type: this.type,
        slug: this.slug
      },
      totalPages: 0
    }
  },
  computed: {
    taxonomy() {
      return this.$store.getters.singleBySlug(this.taxonomyRequest)
    },
    posts() {
      if (this.taxonomy) {
        return this.$store.getters.requestedItems(this.postsRequest)
      }
    },
    title() {
      return `Archive for ${this.taxonomy ? this.taxonomy.name : ''}`
    }
  },
  methods: {
    getTaxonomy() {
      return this.$store.dispatch('getSingleBySlug', this.taxonomyRequest).then(() => {
        this.setPostsRequestParams()
        this.$store.dispatch('updateDocTitle', { parts: [ this.taxonomy.name, this.$store.state.site.name ] })
      })
    },
    getPosts() {
      return this.$store.dispatch('getItems', this.postsRequest)
    },
    setPostsRequestParams() {
      this.postsRequest.params[this.type] = this.taxonomy.id
    },
    setTotalPages() {
      this.totalPages = this.$store.getters.totalPages(this.postsRequest)
    }
  },
  created() {
    this.getTaxonomy().then(() => this.getPosts()).then(() => this.setTotalPages())
  }
}
</script>
