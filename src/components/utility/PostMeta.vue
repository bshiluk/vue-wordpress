<template>
  <div class="post-meta">
    <archive-link
      :archive-id="author"
      archive-type="users"
    />
    <time>{{ date }}</time>
    <span>{{ readingTime }}</span>
  </div>
</template>

<script>
import ArchiveLink from '@/components/utility/ArchiveLink'

export default {
  name: 'PostMeta',
  components: { ArchiveLink },
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      author: this.post.author,
      date: new Date(this.post.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' })
    }
  },
  computed: {
    readingTime() {
      // pretty general estimate
      let words = this.post.content.rendered.split(' ').length + 1
      return `${Math.ceil(words / 200)} min read`
    }
  }
}
</script>

<style>

.post-meta>time::before,
.post-meta>span::before {
  content: '\2022';
  margin: 0 .4rem;
}

</style>
