<template>
  <div class="site-loading-wrap">
    <div class="site-loading">
      <img
        v-if="logo"
        :src="logo.source_url"
        :alt="logo.alt_text"
      />
      <span v-else>{{ siteName }}</span>
      <div></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SiteLoading',
  data() {
    return {
      logoId: this.$store.state.site.logo,
      siteName: this.$store.state.site.name
    }
  },
  computed: {
    logo() {
      return this.$store.getters.singleById({ type: 'media', id: this.logoId })
    }
  }
}
</script>

<style>

.site-loading-wrap {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 3;
  /* background-color: #fff; */
}
.site-loading {
  display: inline-block;
  position: absolute;
  top: 45vh;
  left: 50%;
  max-width: 80%;
  transform: translate3d(-50%, -50%, 0);
}

.site-loading>img {
  display: block;
  position: relative;
  height: 8rem;
  width: auto;
  max-width: 100%;
  margin: 0 auto 1rem auto;
}

.site-loading>span {
  font-size: 2rem;
  font-weight: bold;
}

.site-loading>div {
  height: .2rem;
  background: #f8f8f8;
  margin-top: 1rem;
  overflow: hidden;
  position: relative;
}

.site-loading>div::before,
.site-loading>div::after {
  content: '';
  display: block;
  position: absolute;
  top: 0;
  bottom: 0;
  left: -100%;
  width: 100%;
  background-color: #444;
  transform: translateX(-100%);
  animation: 2.5s ease-in  0s infinite loadingBar;
}

.site-loading>div::after {
  animation-delay: 1.2s;
  animation-timing-function: ease;
}

@keyframes loadingBar {
  0% { transform: translateX(0) }
  50% { transform: translateX(200%) }
  100% { transform: translateX(200%) }
}

</style>
