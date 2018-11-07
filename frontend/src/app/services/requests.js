import unauthenticated from './unauthenticated'
import authenticated from './authenticated'

const { REACT_APP_API_URL } = process.env

const requestsFor = (instance) => {
  // Axios instance defaults
  instance.defaults.timeout = 2500
  instance.defaults.baseURL = REACT_APP_API_URL

  // Requests
  return {
    /**
     * Get from API
     * @param {string} path API path starting with /
     * @param {options} options Axios options
     */
    async get (path = '/', options = {}) {
      return instance.get(path, options)
    },

    /**
     * Post to API
     * @param {string} path API path starting with /
     * @param {*} body Payload body
     * @param {options} options Axios options
     */
    async post (path = '/', body, options = {}) {
      return instance.post(path, body, options)
    },

    /**
     * Put to API
     * @param {string} path API path starting with /
     * @param {*} body Payload body
     * @param {options} options Axios options
     */
    async put (path = '/', body, options = {}) {
      return instance.put(path, body, options)
    },

    /**
     * Delete from API
     * @param {string} path API path starting with /
     * @param {options} options Axios options
     */
    async delete (path = '/', options = {}) {
      return instance.delete(path, options)
    }
  }
}

const requests = {
  authenticated: requestsFor(authenticated),
  unauthenticated: requestsFor(unauthenticated)
}

export default requests
