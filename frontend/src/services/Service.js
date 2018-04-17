import fetcher from '../helpers/fetcher'

/**
 * Default services (aka C.R.U.D.)
 */
class Service {
  /**
     * Constructor. Can receive the route to API's controller
     * @param {string} route
     */
  constructor (route = '/') {
    this.route = route
  }

  /**
     * Create a new object
     * @param {form params} values
     */
  async create (values) {
    let result = await fetcher.post(`${this.route}`, values)

    if (result.status !== 200) {
      this.catchErrors(result)
    }

    return result
  }

  /**
     * List all objects. Can receive a list of filters fields
     * @param {params | array} fields
     */
  async index (fields = '') {
    // Todo: implement IQuerable backend.
    let result = await fetcher.get(`${this.route}`)

    if (result.status !== 200) {
      this.catchErrors(result)
    }

    return result
  }

  /**
     * Get a single object.
     * @param {UUID} uid
     */
  async get (uid) {
    let result = await fetcher.get(`${this.route}/${uid}`)

    if (result.status !== 200) {
      this.catchErrors(result)
    }

    return result
  }

  /**
     * Update a specific object
     * @param {UUID} uid
     * @param {form params} values
     */
  async update (uid, values) {
    let result = await fetcher.put(`${this.route}/${uid}`, values)

    if (result.status !== 200) {
      this.catchErrors(result)
    }

    return result
  }

  /**
     * Destroy an object
     * @param {UUID} uid
     */
  async delete (uid) {
    let result = await fetcher.delete(`${this.route}/${uid}`)

    if (result.status !== 200) {
      this.catchErrors(result)
    }

    return result
  }

  catchErrors (error) {
    console.log(`SERVICE ${this.route} ERROR:`, error)
  }
}

export default Service
