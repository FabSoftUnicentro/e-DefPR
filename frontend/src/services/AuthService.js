import fetcher from 'helpers/fetcher'

class AuthService {
  constructor () {
    this.sessionName = 'edef'
    this.route = '/user'
  }

  /**
   * Authenticate users.
   * @param {email, password} login info 
   */
  async login ({ email, password }) {
    const result = await fetcher.post(`${this.route}/authenticate`, { email, password })

    if (result.status === 200) {
      this.user = result.data
    }

    return result
  }

  logout () {
    window.sessionStorage.clear()
    window.location.href = '/'
  }

  /**
   * Store authenticated user. 
   */
  set user ({ token, name, mustChangePassword }) {
    window.sessionStorage.setItem(
      this.sessionName,
      JSON.stringify({ token, name, mustChangePassword })
    )
  }

  /**
   * Retrive user from store.
   */
  get user () {
    try {
      return JSON.parse(window.sessionStorage.getItem(this.sessionName))
    }
    catch (error) {
      return undefined
    }
  }

  get token () {
    const user = this.user
    return user ? user : undefined
  }

  /**
   * Client-side check if user is authenticated.
   */
  isAuthenticated () {
    return !!window.sessionStorage.getItem(this.sessionName)
  }
}

export default (new AuthService())
