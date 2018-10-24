import Service from './Service'

class Authentication extends Service {
  async signin (login, password) {
    const result = await this.post('/user/authenticate', { login, password })

    if (result.status === 200) {
      this.token = result.token
      this.account = {
        name: result.name,
        must_change_password: result.must_change_password
      }
    }

    return result
  }

  async logout () {
    const result = await this.get('/user/logout')

    if ((result.status === 200) || (result.status === 401)) {
      this.clearCookies()
      localStorage.clear()

      return true
    } else {
    }

    return false
  }
}

export default Authentication
