<template>
  <a
    :href="link"
    :title="title"
    v-html="title"
  ></a>
</template>

<script>
export default {
  name: 'ArchiveLink',
  props: {
    archiveType: {
      type: String,
      required: true
    },
    archiveId: {
      type: Number,
      required: true
    }
  },
  data() {
    return {}
  },
  computed: {
    request() {
      return { type: this.archiveType, id: this.archiveId, batch: true }
    },
    item() {
      return this.$store.getters.singleById(this.request)
    },
    link() {
      return this.item ? this.item.link : ''
    },
    title() {
      return this.item ? this.item.name : ''
    }
  },
  methods: {
    getArchiveItem() {
      this.$store.dispatch('getSingleById', this.request)
    }
  },
  created() {
    this.getArchiveItem()
  }
}

</script>
