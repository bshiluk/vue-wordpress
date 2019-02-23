<template>
  <main>
    <section v-if="posts.length">
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
  name: 'Home',
  components: {
    PostItem,
    Pagination
  },
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
      return { type: 'posts', params: { per_page: this.per_page, page: this.page }, showLoading: true }
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
  created() {
    this.getPosts().then(() => this.setTotalPages())
  }
}
</script>
