<template>
  <section class="pagination">
    <a
      v-show="current !== 1"
      class="pagination__previous"
      href="#"
      rel="previous"
      v-html="'&lsaquo; Previous'"
      @click.prevent="gotoPage(current - 1)"
    ></a>
    <a
      v-show="current !== total"
      class="pagination__next"
      href="#"
      rel="next"
      v-html="'Next &rsaquo;'"
      @click.prevent="gotoPage(current + 1)"
    ></a>
  </section>
</template>

<script>
export default {
  name: 'Pagination',
  props: {
    current: {
      type: Number,
      required: true
    },
    total: {
      type: Number,
      required: true
    }
  },
  data() {
    return {}
  },
  methods: {
    gotoPage(page) {
      if (! page || page > this.total) return
      let path = this.$route.path
      if (this.current === 1 && page !== 1) {
        path += `page/${page}/`
      } else if (page === 1) {
        path = path.replace(`page/${this.current}/`, '')
      } else {
        path = path.replace(`page/${this.current}/`, `page/${page}/`)
      }
      this.$router.push(path)
    }
  }
}

</script>

<style>

  .pagination {
    position: relative;
    padding-bottom: 4rem;
    border-bottom: 1px solid #e8e8e8;
  }

  .pagination>a {
    font-size: 1.8rem;
    display: inline-block;
  }
  .pagination>a:first-of-type {
    float: left;
  }
  
  .pagination>a:last-of-type {
    float: right;
  }
</style>

