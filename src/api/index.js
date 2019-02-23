import axios from 'axios'


const { url } = __VUE_WORDPRESS__.routing

const ajax = axios.create(
  {
    baseURL: `${url}/wp-json/wp/v2/`,
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    }
  }
)

const batchRequest = {}

function addBatchId(type, id) {
  if ( ! batchRequest[type] ) {
    batchRequest[type] = {}
    batchRequest[type].ids = [id]
    batchRequest[type].request = new Promise((resolve, reject) => {
      setTimeout(() => {
        resolve(batchRequestIds(type))
        batchRequest[type] = null
      }, 100)
    })
  } else if( ! batchRequest[type].ids.includes(id) ){
    batchRequest[type].ids.push(id)
  }
}

function batchRequestIds(type) {
  return ajax.get(`/${type}/`, { params: { include: batchRequest[type].ids, per_page: 100 } })
}

export const fetchSingleById = ({ type, id, batch = false }) => {
  if (batch) {
    addBatchId(type, id)
    return batchRequest[type].request
  } else {
    return ajax.get(`/${type}/${id}`)
  }
}

export const fetchSingle = ({ type, params = {} }) => {
  return ajax.get(`/${type}/`, { params })
}

export const fetchItems = ({ type, params = {} }) => {
  return ajax.get(`/${type}/`, { params })
}
