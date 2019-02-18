import Vue from 'vue'
import Vuex from 'vuex'
import getters from './getters'
import mutations from './mutations'
import actions from './actions'

Vue.use(Vuex)

const { state } = __VUE_WORDPRESS__

export default new Vuex.Store({
  state,
  getters,
  mutations,
  actions
})
