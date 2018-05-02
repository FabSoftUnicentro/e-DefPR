import fetcher from '../helpers/fetcher'
import { SESSION_NAME } from '../helpers/app.config'

class AuthService {
  constructor () {
    this.route = '/person'
  }

  async login (cpf, password) {
    let result = await fetcher.post(`${this.route}/authenticate`, { cpf, password })

    if (result.status === 200) {
      this.authSucess(result.data)
    } else if (result.status !== 404) {
      console.log('ERROR', result.data)
    }

    return result
  }

  authSucess (data) {
    window.sessionStorage.setItem(SESSION_NAME, JSON.stringify(data))
  }

  get loginInfo () {
    try {
      const info = window.sessionStorage.getItem(SESSION_NAME)
      return JSON.parse(info)
    } catch (e) {
      this.logout()
      return null
    }
  }

  get token () {
    return this.loginInfo ? null : this.loginInfo.token
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
