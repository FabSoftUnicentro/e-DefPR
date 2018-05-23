import fetcher from '../helpers/fetcher'
import { SESSION_NAME } from '../helpers/app.config'

class AuthService {
  constructor () {
    this.route = '/user'
  }

  async login (email, password) {
    console.log(`${this.route}/authenticate`)
    console.log({ email, password })
    let result = await fetcher.post(`${this.route}/authenticate/`, { email, password })

    
    if (result.status === 200) {
      this.authSucess(result.data)
    } else if (result.status >= 400 && result.status <= 404) {
      console.log('ERROR', result.data)
    }

    return result
  }

  authSucess (data) {
    window.sessionStorage.setItem(SESSION_NAME, data)
  }

  get loginInfo () {
    try {
      return window.sessionStorage.getItem(SESSION_NAME)
    } catch (e) {
      this.logout()
      return null
    }
  }

  get token () {
    return this.loginInfo ? null : this.loginInfo
  }

  logout () {
    window.sessionStorage.clear()
    window.location.href = '/'
  }

  isAuthenticated () {
    return !!window.sessionStorage.getItem(SESSION_NAME)
  }

  /*
    // Carece de implementação (backend)
    passwordRecovery(email){

    }

    changePassword(token, newPassword){

    }

    */
}

export default (new AuthService())
