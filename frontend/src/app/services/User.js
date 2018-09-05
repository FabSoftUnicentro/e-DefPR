import Service from './Service'

class User extends Service {
  async me () {
    const result = await this.get('/user/me')

    if (result.status === 200) {
      this.account = {
        name: result.data.name,
        must_change_password: result.data.must_change_password
      }
    }

    return result.data
  }

  async list (page = '1') {
    return this.get(`/user?page=${page}`)
  }

  async create (user) {
    return this.post('/user', user)
  }

  async update () {
    return Promise.resolve()
  }

  get name () {
    return this.account ? this.account.name : ''
  }
}

export default User
