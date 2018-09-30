import Service from './Service'

class Location extends Service {
  async states () {
    return this.get('/state')
  }

  async getStateCities (state) {
    if (!state) {
      return []
    }

    return this.get(`/city/state/${state}`)
  }
}

export default Location
