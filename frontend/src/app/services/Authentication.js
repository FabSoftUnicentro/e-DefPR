import Service from './Service'

class Authentication extends Service {
  constructor () {
    super ()
  }

  async signin (login, password) {
    if (!login || !password) {
      return { statusCode: 'EMPTY_LOGIN_OR_PASSWORD' }
    }

    const result = await this.post('/user/authenticate', {
      login, password
    })

    console.log(result)
  }

  logout () {

  }

  get isAuthenticated () {
    return false
  }
}

export default Authentication
