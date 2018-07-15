class Service {
  constructor () {
    this.authorization = undefined
  }

  async get (path, headers) {

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
    }
    catch (error) {
      throw error
    }
  }

  async update (path, body, headers) {

  }

  async path (path, body, headers) {

  }

  buildHeaders(headers = {}) {
    return {
      'Content-Type': 'application/json',
      ...headers
    }
  }

  get url () {
    return 'http://localhost:8000/api'
  }
}

export default Service;
