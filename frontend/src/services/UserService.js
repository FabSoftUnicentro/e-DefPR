import Service from './Service'

class UserService extends Service {
  constructor () {
    super('/user')
  }
}

export default (new UserService())
