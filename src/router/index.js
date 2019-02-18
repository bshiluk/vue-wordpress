import Vue from 'vue'
import Router from 'vue-router'
import routes from './routes'

const { url } = __VUE_WORDPRESS__.routing

Vue.use(Router)

export default new Router({
  base: url.replace(window.location.origin, ''),
  mode: 'history',
  routes: routes
})
