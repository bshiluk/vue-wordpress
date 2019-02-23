<template>
  <main>
    <article v-if="post">
      <header>
        <responsive-image
          v-if="post.featured_media"
          :media-id="post.featured_media"
          :sizes="'(max-width: 1200px) 100vw, 1200px'"
        />
        <h1 v-html="post.title.rendered"></h1>
        <post-meta :post="post" />
        <post-taxonomies :post="post" />
      </header>
      <div v-html="post.content.rendered"></div>
    </article>
  </main>
</template>

<script>
import ResponsiveImage from '@/components/utility/ResponsiveImage'
import PostMeta from '@/components/utility/PostMeta'
import PostTaxonomies from '@/components/utility/PostTaxonomies'

export default {
  name: 'Single',
  components: { 
    ResponsiveImage,
    PostMeta,
    PostTaxonomies
  },
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
      return { type: 'posts', slug: this.slug, showLoading: true }
    }
  },
  methods: {
    getPost() {
      this.$store.dispatch('getSingleBySlug', this.request).then(() => {
        this.$store.dispatch('updateDocTitle', { parts: [ this.post.title.rendered, this.$store.state.site.name ] })
      })
    }
  },
  created() {
    this.getPost()
  }
}
</script>
