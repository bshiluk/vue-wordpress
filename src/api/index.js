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

export const fetchSingle = ({ type, params = {} }) => {
  return ajax.get(`/${type}/`, { params })
}

export const fetchSingleById = ({ type, id }) => {
  return ajax.get(`/${type}/${id}`)
}

export const fetchItems = ({ type, params = {} }) => {
  return ajax.get(`/${type}/`, { params })
}
