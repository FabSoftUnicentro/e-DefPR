import authService from 'services/AuthService'

const API_URL = process.env.REACT_APP_API_URL
const { fetch } = window

/**
 * Default fetcher for all controllers.
 * Usage: fetcher.[METHOD](CONTROLLER_PATH, ...rest)
 */
const fetcher = {
  /**
   * Async getter from api.
   * @param {string | path} controllerPath
   * Returns { status: HTTP_CODE, data: json }
   */
  async get (controllerPath = '/') {
    let response = await fetch(`${API_URL}${controllerPath}`, { method: 'GET', ...this.options })
    let data = await response.json()

    return {
      status: response.status,
      data: data
    }
  },

  /**
   * Async post to api.
   * @param {string | path} controllerPath
   * @param {object} body
   * Returns { status: HTTP_CODE, data: json }
   */
  async post (controllerPath = '/', body = {}) {
    let response = await fetch(`${API_URL}${controllerPath}`, {
      method: 'POST',
      body: JSON.stringify(body),
      ...this.options
    })

    let data = await response.json()

    return {
      status: response.status,
      data: data
    }
  },

  /**
   * Async put to api.
   * @param {string | path} controllerPath
   * @param {object} body
   * Returns { status: HTTP_CODE, data: json }
   */
  async put (controllerPath = '/', body = {}) {
    let response = await fetch(`${API_URL}${controllerPath}`, {
      method: 'PUT',
      body: JSON.stringify(body),
      ...this.options
    })

    let data = await response.json()

    return {
      status: response.status,
      data: data
    }
  },

  /**
   * Async delete from api.
   * @param {string | path} controllerPath
   * Returns { status: HTTP_CODE, data: json }
   */
  async delete (controllerPath = '/') {
    let response = await fetch(`${API_URL}${controllerPath}`, {
      method: 'DELETE',
      ...this.options
    })

    let data = await response.json()

    return {
      status: response.status,
      data: data
    }
  },

  get options () {
    const options = {}
    options['mode'] = 'cors'
    options['headers'] = this.headers

    return options
  },

  get headers () {
    const header = {}
    header['Content-Type'] = 'application/json'

    if (authService.isAuthenticated) {
      header['Authorization'] = `Bearer ${authService.token}`
    }
    
    return header
  }
}

export default fetcher
