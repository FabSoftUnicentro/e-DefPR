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

  get localAccount () {
    if (!this.hasLocalAccount) {
      return undefined
    }

    return localStorage.getItem(this.USER_ACCOUNT)
  }

  get hasLocalAccount () {
    return !!localStorage.getItem(this.USER_ACCOUNT)
  }
}

export default User
