import Service from './Service'

class Location extends Service {
  async states () {
    try {
      const result = await this.get('/state')
      return result.data
    } catch (error) {
      throw error
    }
  }

  async getStateCities (state) {
    if (!state) {
      return []
    }

    try {
      const result = await this.get(`/city/state/${state}`)
      return result.data
    } catch (error) {
      throw error
    }
  }
}

export default Location
