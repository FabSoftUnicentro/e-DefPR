import Service from './Service'

class Role extends Service {
  async create (account) {
    return this.post('/role', account)
  }

  async list (page = '1') {
    return this.get(`/role?page=${page}`)
  }
}

export default Role
