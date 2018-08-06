const { localStorage, fetch } = window

class Service {
  USER_IDX = 'EDEF_USER_IDX'

  constructor () {
    this.authorization = undefined
  }

  async get (path, headers) {
    try {
      const response = await fetch(`${this.url}${path}`, {
        method: 'GET',
        mode: 'cors',
        headers: this.buildHeaders(headers)
      })

      if (response.status === 200) {
        const result = await response.json()
        return { statusCode: 'SUCCESS', data: result }
      }

      if (response.status === 500) {
        throw response
      }

      return {
        status: response.status,
        statusCode: response.statusText,
        data: response
      }
    } catch (error) {
      throw error
    }
  }

  async post (path, body = {}, headers) {
    try {
      const response = await fetch(`${this.url}${path}`, {
        method: 'POST',
        mode: 'cors',
        body: JSON.stringify(body),
        headers: this.buildHeaders(headers)
      })

      if (response.status === 200) {
        const result = await response.json()
        return { statusCode: 'SUCCESS', data: result }
      }

      if (response.status === 500) {
        throw response
      }

      return {
        status: response.status,
        statusCode: response.statusText,
        data: response
      }
    } catch (error) {
      throw error
    }
  }

  async update (path, body, headers) {

  }

  async path (path, body, headers) {

  }

  buildHeaders (headers = {}) {
    return {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${this.token}`,
      ...headers
    }
  }

  get token () {
    if (!this.hasToken) {
      return undefined
    }

    return localStorage.getItem(this.USER_IDX)
  }

  get hasToken () {
    return !!localStorage.getItem(this.USER_IDX)
  }

  get url () {
    return process.env.REACT_APP_API_URL
  }
}

export default Service
