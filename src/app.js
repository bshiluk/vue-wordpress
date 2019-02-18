import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

new Vue({
  el: '#vue-wordpress-app',
  render: h => h(App),
  router,
  store
})
