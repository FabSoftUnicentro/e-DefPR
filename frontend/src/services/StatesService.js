import Service from './Service'

class StatesService extends Service {
  constructor () {
    super('/state')
  }
}

export default (new StatesService())
