import Vue from 'vue'

export default {
  ADD_ITEM(state, { type, item }) {
    if (item && type && ! state[type].hasOwnProperty(item.id)) {
      Vue.set(state[type], item.id, item)
    }
  },
  ADD_REQUEST(state, { type, request }) {
    state[type].requests.push(request)
  }
}
