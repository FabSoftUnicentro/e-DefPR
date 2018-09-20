import Cookie from 'js-cookie'

const URL = process.env.REACT_APP_API_URL
const EDEF_IDX = process.env.REACT_APP_COOKIE_NAME
const IDX = 'USER_IDX'

class Service {
  async post (path = '/', body) {
    try {
      const response = await fetch(`${URL}${path}`, {
        method: 'POST',
        mode: 'cors',
        body: JSON.stringify(body),
        headers: { ...this.headers }
      })
      return {
        status: response.status,
        ...(await response.json())
      }
    } catch (error) {
      throw error
    }
  }

  async put (path = '/', body) {
    try {
      const response = await fetch(`${URL}${path}`, {
        method: 'PUT',
        mode: 'cors',
        body: JSON.stringify(body),
        headers: { ...this.headers }
      })
      return {
        status: response.status,
        ...(await response.json())
      }
    } catch (error) {
      throw error
    }
  }

  async get (path = '/') {
    try {
      const response = await fetch(`${URL}${path}`, {
        method: 'GET',
        mode: 'cors',
        headers: { ...this.headers }
      })

      return {
        status: response.status,
        ...(await response.json())
      }
    } catch (error) {
      console.error(error)
    }
  }

  async update () {
    return Promise.resolve()
  }

  get token () {
    return Cookie.get(EDEF_IDX)
  }

  set token (token) {
    Cookie.set(EDEF_IDX, token)
  }

  get isAuthenticated () {
    return !!this.token
  }

  get account () {
    if (!localStorage.getItem(IDX)) {
      return undefined
    }

    return JSON.parse(localStorage.getItem(IDX))
  }

  set account (data) {
    localStorage.setItem(IDX, JSON.stringify(data))
  }

  get headers () {
    return {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${this.token}`
    }
  }

  clearCookies () {
    Cookie.remove(EDEF_IDX)
  }

  kick () {
    this.clearCookies()
    localStorage.clear()
    window.location.href = '/'
  }
}

export default Service
