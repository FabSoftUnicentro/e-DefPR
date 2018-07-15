import Service from './Service'

class Authentication extends Service {
  async signin (login, password) {
    if (!login || !password) {
      return { statusCode: 'EMPTY_LOGIN_OR_PASSWORD' }
    }

    const result = await this.post('/user/authenticate', {
      login, password
    })

    if (result.statusCode === 'SUCCESS') {
      localStorage.setItem(this.USER_IDX, result.data.token)
    }

    return result
  }

  logout () {
    localStorage.clear()
    return true
  }

  get isAuthenticated () {
    return this.hasToken && this.hasAccount
  }

  get hasAccount () {
    return !!localStorage.getItem('EDEF_IDENTITY')
  }
}

export default Authentication
