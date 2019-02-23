<template>
  <div 
    id="vue-wordpress-app"
    class="container"
    @click="handleClicks"
  >
    <div
      class="site-branding"
      @click="$router.push('/')"
    >
      <img
        v-if="logo"
        class="logo"
        :src="logo.source_url"
        :alt="logo.alt_text"
      />
      <span>{{ site.name }}</span>
    </div>
    <nav-menu
      class="main-menu" 
      name="main"
    />
    <transition
      name="fade"
      mode="out-in"
      @after-leave="updateScroll"
    >
      <router-view :key="$route.path" />
    </transition>
    <transition name="fade">
      <site-loading v-if="loading" />
    </transition>
  </div>
</template>

<script>
import NavMenu from '@/components/template-parts/NavMenu'
import SiteLoading from '@/components/utility/SiteLoading'

export default {
  components: {
    NavMenu,
    SiteLoading
  },
  data() {
    return {
      site: this.$store.state.site
    }
  },
  computed: {
    loading() {
      return this.$store.state.site.loading
    },
    logo() {
      if (this.site.logo) {
        return this.$store.getters.singleById({ type: 'media', id: this.site.logo })
      }
    }
  },
  methods: {
    getLinkEl(el) {
      while (el.parentNode) {
        if (el.tagName === 'A') return el
        el = el.parentNode
      }
    },
    handleClicks (e) {
      const a = this.getLinkEl(e.target)
      if (a && a.href.includes(this.site.url)) {
        const { altKey, ctrlKey, metaKey, shiftKey, button, defaultPrevented } = e
        // don't handle if has class 'no-router'
        if (a.className.includes('no-router')) return
        // don't handle with control keys
        if (metaKey || altKey || ctrlKey || shiftKey) return
        // don't handle when preventDefault called
        if (defaultPrevented) return
        // don't handle right clicks
        if (button !== undefined && button !== 0) return
        // don't handle if `target="_blank"`
        if (a.target && a.target.includes('_blank')) return
        // don't handle same page links
        let currentURL = new URL(a.href, window.location.href)
        if (currentURL && currentURL.pathname === window.location.pathname) {
          // if same page link has same hash prevent default reload
          if (currentURL.hash === window.location.hash) e.preventDefault()
          return
        }
        // Prevent default and push to vue-router
        e.preventDefault()
        let path = a.href.replace(this.site.url, '')
        this.$router.push(path)
      }
    },
    updateScroll() {
      window.scroll(0,0)
    }
  }
}
</script>

<style>

.site-branding {
  display: inline-block;
  padding: 1rem 0;
  cursor: pointer
}

.logo {
  display: inline-block;
  vertical-align: middle;
  height: 4.8rem;
  width: auto;
  margin: 0 .4rem 0 0;
}

.site-branding>span {
  vertical-align: middle;
  font-size: 2.4rem;
  font-weight: bold;
}

.main-menu {
  position: sticky;
  top: -1px;
  z-index: 2;
  display: flex;
  flex-flow: row wrap;
  justify-content: flex-start;
  background: #fff;
  padding: 1rem 0;
  border-top: 1px solid rgba(0,0,0,.05);
  border-bottom: 1px solid rgba(0,0,0,.05);
}

.main-menu>a {
  margin-right: 2%;
}

/* Vue transition classes
-------------------------------------------- */

.fade-enter-active {
  transition: opacity .4s cubic-bezier(.4,0,0,1);
}

.fade-leave-active {
  transition: opacity .2s cubic-bezier(.4,0,0,1);
}

.fade-enter-to,
.fade-leave {
  opacity: 1;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

</style>
