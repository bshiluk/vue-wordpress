export default {
  menu: state => ({ name }) => {
    return state.menus[name]
  },
  request: state => ({ type, params }) => {
    return state[type].requests.find(req => {
      if (Object.keys(req.params).length === Object.keys(params).length) {
        return Object.keys(req.params).every(key => req.params[key] === params[key])
      }
    })
  },
  totalPages: (state, getters) => ({ type, params }) => {
    let request = getters.request({ type, params })
    return request ? request.totalPages : 0
  },
  requestedItems: (state, getters) => ({ type, params }) => {
    let request = getters.request({ type, params })
    return request ? request.data.map(id => state[type][id]) : Array.from({ length: parseInt(state.site.posts_per_page) }).map((v,i) => ({ id: `loading${i}` }))
  },
  singleBySlug: state => ({ type, slug }) => {
    for (let id in state[type]) {
      if (state[type][id].slug === slug) {
        return state[type][id]
      }
    }
  },
  singleById: state => ({ type, id }) => {
    return state[type][id]
  }
}
