import fetcher from '../helpers/fetcher'

class PostcodeService {
  /**
     * Get the address object from a CEP.
     * @param {CEP} cep
     */
  async get (cep) {
    let result = await fetcher.get(`/postcode/${cep}`)

    if (result.status !== 200) {
      this.catchErrors(result)
    }

    return result
  }
}

export default (new PostcodeService())
