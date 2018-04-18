import fetcher from '../helpers/fetcher'
import { SESSION_NAME } from '../helpers/app.config'

const {localStorage} = window

class AuthService {
  constructor () {
    this.route = '/person'
  }

  async login (cpf, password) {
    let result = await fetcher.post(`${this.route}/authenticate`, { cpf, password })

    if (result.status !== 200) {
      console.log('ERROR', result)
    }

    if (result.status === 200) {
      this.authSucess(result.data)
    }

    return result
  }

  authSucess (data) {
    localStorage.setItem(SESSION_NAME, JSON.stringify(data))
  }

  get localSession () {
    return JSON.parse(localStorage.getItem(SESSION_NAME))
  }

  get token () {
    if (!this.localSession) {
      return false
    }

    return this.localSession.token
  }

  logout () {
    localStorage.clear()
  }

  isAuthenticated () {
    return !!this.token && this.localSession.data.mustChangePassword === false 
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
