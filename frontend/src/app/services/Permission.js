import Service from './Service'

class Permission extends Service {
  async create (account) {
    return this.post('/permission', account)
  }

  async list (page = '1') {
    return this.get(`/permission?page=${page}`)
  }
}

export default Permission
