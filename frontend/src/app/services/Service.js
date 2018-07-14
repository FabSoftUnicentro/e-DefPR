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
        return await response.json()
      }

      if (response.status === 500) {
        throw { statusCode: 'SERVER_ERROR', response }
      }

      return { status: response.status, statusCode: response.statusText, response }
    }
    catch (error) {
      throw { statusCode: 'INTERNAL_ERROR', error }
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
