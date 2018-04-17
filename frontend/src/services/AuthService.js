import fetcher from '../helpers/fetcher'
import { SESSION_NAME } from '../helpers/app.config'

class AuthService {
  constructor () {
    this.route = '/person/authenticate'
  }

  async login (cpf, password) {
    let result = await fetcher.post(`${this.route}`, { cpf, password })

    if (result.status !== 200) {
      console.log('ERROR', result)
    }

    if (result.status === 200) {
      this.authSucess(result.data)
    }

    return result
  }

  authSucess (data) {
    window.sessionStorage.setItem(SESSION_NAME, data.token)
  }

  logout () {
    window.sessionStorage.clear()
  }

  isAuthenticated () {
    return window.sessionStorage.getItem(SESSION_NAME) === true
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
