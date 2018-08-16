import Service from './Service'

class Assisted extends Service {
  async create (account) {
    try {
      const result = await this.post('/assisted', account)

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
      const result = await this.get(`/assisted/?page=${page}`)
      return result.data
    } catch (error) {
      throw error
    }
  }
}

export default Assisted
