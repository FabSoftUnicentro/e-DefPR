import Service from './Service'

class Assisted extends Service {
  async create (account) {
    return this.post('/assisted', account)
  }

  async list (page = '1') {
    return this.get(`/assisted?page=${page}`)
  }
}

export default Assisted
