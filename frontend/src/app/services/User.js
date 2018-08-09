import Service from './Service'

class User extends Service {
  USER_ACCOUNT = 'EDEF_IDENTITY'

  async account () {
    try {
      const result = await this.get('/user/me')
      
      if (result.statusCode === 'SUCCESS') {
        localStorage.setItem(this.USER_ACCOUNT, JSON.stringify({
          name: result.data.data.name,
          must_change_password: !!result.data.data.must_change_password
        }))
        return result.data
      }

      return undefined
    }
    catch (error) {
      throw error
    }
  }

  async create (account) {
    try {
      const result = await this.post('/user', account)

      if (result.statusCode === 'SUCCESS') {
        return result
      }

      return result
    }
    catch (error) {
      throw error
    }
  }

  async list (page = '1') {
    try {
      const result = await this.get(`/user/?page=${page}`)
      return result.data
    } catch (error) {
      throw error
    }
  }

  get localAccount () {
    if (!this.hasLocalAccount) {
      return undefined
    }

    return JSON.parse(localStorage.getItem(this.USER_ACCOUNT))
  }

  get hasLocalAccount () {
    return !!localStorage.getItem(this.USER_ACCOUNT)
  }

  get name () {
    return this.localAccount.name
  }
}

export default User
