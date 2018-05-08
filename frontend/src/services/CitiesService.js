import Service from './Service'


class CityService extends Service {
  constructor () {
    super('/cities')
  }

  /**
   * List all cities that belong to a specific state.
   * @param {UUID} state_uid
   */
  async listByState (stateUid) {
    if (!stateUid) {
      return []
    }
    let result = await fetcher.get(`${this.route}/state/${stateUid}`) /// TODO verify backend route

    if (result.status !== 200) {
      this.catchErrors(result)
    }

    return result
  }
}

export default (new CityService())
