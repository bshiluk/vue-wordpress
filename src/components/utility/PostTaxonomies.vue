<template>
  <div>
    <div
      v-if="post.categories.length"
      class="categories"
    >
      <span>Posted in:</span>
      <archive-link
        v-for="category in post.categories"
        :key="category"
        archive-type="categories"
        :archive-id="category"
      />
    </div>
    <div
      v-if="post.tags.length"
      class="tags"
    >
      <span>Tagged:</span>
      <archive-link
        v-for="tag in post.tags"
        :key="tag"
        archive-type="tags"
        :archive-id="tag"
      />
    </div>
  </div>
</template>

<script>
import ArchiveLink from '@/components/utility/ArchiveLink'

export default {
  name: 'PostTaxonomies',
  components: { ArchiveLink },
  props: {
    post: {
      type: Object,
      required: true
    }
  },
  data() {
    return {}
  }
}
</script>

<style>

.categories>a,
.tags>a {
  margin: 0 .4rem;
}

</style>
