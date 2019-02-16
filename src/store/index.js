import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

console.log( __VUE_WORDPRESS__.state )

export default new Vuex.Store({
  state: __VUE_WORDPRESS__.state
})
