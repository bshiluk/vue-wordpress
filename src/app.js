import Vue from 'vue'
import App from './App.vue'
import store from './store'

new Vue({
  el: '#vue-wordpress-app',
  render: h => h(App),
  store
})
