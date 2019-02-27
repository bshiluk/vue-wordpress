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
  name: 'DateArchive',
  components: {
    PostItem,
    Pagination
  },
  props: {
    page: {
      type: Number,
      required: true
    },
    year: {
      type: String,
      required: true
    },
    month: {
      type: String,
      required: false
    },
    day: {
      type: String,
      required: false
    }
  },
  data () {
    return {
      totalPages: 0,
      request: {
        type: 'posts',
        params: {
          per_page: this.$store.state.site.posts_per_page,
          page: this.page,
          after: this.after,
          before: this.before
        },
        showLoading: true
      }
    }
  },
  computed: {
    before() {
      let before = new Date(this.after)
      if (this.day) {
        before.setUTCDate(before.getUTCDate() + 1)
      } else if (this.month) {
        before.setUTCMonth(before.getUTCMonth() + 1)
      } else {
        before.setUTCFullYear(before.getUTCFullYear() + 1)
      }
      return before.toISOString()
    },
    after() {
      return `${this.year}${this.month ? '-' + this.month : '-01'}${this.day ? '-' + this.day : '-01'}T00:00:00.000Z`
    },
    posts() {
      return this.$store.getters.requestedItems(this.request)
    },
    title() {
      let options = { year: 'numeric' }
      if (this.month){
        options.month = 'long'
        if (this.day) options.day = 'numeric'
      }
      return `Archive for ${new Date(this.after.replace('T0', 'T1')).toLocaleDateString('en-US', options)}`
    }
  },
  methods: {
    getPosts() {
      return this.$store.dispatch('getItems', this.request)
    },
    setAfterParam() {
      this.request.params.after = `${this.year}${this.month ? '-' + this.month : '-01'}${this.day ? '-' + this.day : '-01'}T00:00:00.000Z`
    },
    setBeforeParam() {
      let before = new Date(this.request.params.after)
      if (this.day) {
        before.setUTCDate(before.getUTCDate() + 1)
      } else if (this.month) {
        before.setUTCMonth(before.getUTCMonth() + 1)
      } else {
        before.setUTCFullYear(before.getUTCFullYear() + 1)
      }
      this.request.params.before = before.toISOString()
    },
    setTotalPages() {
      this.totalPages = this.$store.getters.totalPages(this.request)
    }
  },
  created() {
    this.setAfterParam()
    this.setBeforeParam()
    this.getPosts().then(() => this.setTotalPages())
  }
}
</script>
