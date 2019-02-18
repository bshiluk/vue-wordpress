import {
  fetchItems,
  fetchSingle,
  fetchSingleById
} from '@/api'

export default {
  getSingleBySlug ({ getters, commit }, { type, slug }) {
    if ( ! getters.singleBySlug({ type, slug }) ) {
      return fetchSingle({ type, params: { slug } }).then(({ data: [ item ] }) => {
        commit('ADD_ITEM', { type, item  })
      })
    }
  },
  getSingleById ({ getters, commit }, { type, id }) {
    if ( ! getters.singleById({ type, id }) ) {
      return fetchSingleById({ type, id }).then(({ data: item }) => {
        commit('ADD_ITEM', { type, item  })
      })
    }
  },
  getItems ({ getters, commit }, { type, params }) {
    if ( ! getters.request({ type, params }) ) {
      return fetchItems({ type, params })
        .then(({ data: items, headers: { 'x-wp-total': total, 'x-wp-totalpages': totalPages } }) => {
          items.forEach(item => commit('ADD_ITEM', { type, item }))
          commit('ADD_REQUEST', { type, request: { params, total: parseInt(total), totalPages: parseInt(totalPages), data: items.map(i => i.id) } })
        })
    }
  }
}
