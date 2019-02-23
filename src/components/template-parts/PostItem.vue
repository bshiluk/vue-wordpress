<template>
  <article class="post">
    <responsive-image
      v-if="post.featured_media"
      class="post__featured-media"
      :media-id="post.featured_media"
      :sizes="'(max-width: 680px) 40vw, 400px'"
    />
    <div class="post__content">
      <h2>
        <a 
          :href="post.link"
          :title="post.title.rendered"
          v-html="post.title.rendered"
        ></a>
      </h2>
      <post-meta :post="post" />
      <div v-html="post.excerpt.rendered"></div>
      <post-taxonomies :post="post" />
    </div>
  </article>
</template>

<script>
import ResponsiveImage from '@/components/utility/ResponsiveImage'
import PostMeta from '@/components/utility/PostMeta'
import PostTaxonomies from '@/components/utility/PostTaxonomies'

export default {
  name: 'PostItem',
  components: {
    ResponsiveImage,
    PostMeta,
    PostTaxonomies
  },
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

.post {
  display: flex;
  flex-flow: row-reverse nowrap;
  justify-content: flex-start;
  align-items: flex-start;
  margin: 4rem 0;
  padding-bottom: 4rem;
  border-bottom: 1px solid #e8e8e8;
}

.post__featured-media {
  display: block;
  flex: 0 0 33%;
  max-width: 400px;
  height: 240px;
  margin-left: 5%;
}

.post__featured-media > img {
  position: absolute;
  top: 50%;
  left: 50%;
  min-height: 100%;
  min-width: 100%;
  transform: translate3d(-50%,-50%,0);
}

.post__content {
  flex: 1 1 auto;
  max-width: 100%;
  overflow: hidden;
}

.post__content > h2 {
  margin-top: 0;
}

@media (max-width: 680px) {
  .post { 
    flex-flow: row wrap;
  }
  .post__featured-media {
    flex: 0 1 100%;
    max-width: 100%;
    margin: 0 0 2rem 0;
  }
}

</style>
