import Service from './Service'

class Location extends Service {
  async states () {
    const result = await this.get('/state')
    return result.data
  }

  async getStateCities (state) {
    if (!state) {
      return []
    }

    const result = await this.get(`/city/state/${state}`)
    console.log(result)

    return result.data
  }
}

export default Location
