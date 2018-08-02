import Authentication from './Authentication'
import User from './User'
import Location from './Location'

const authentication = new Authentication()
const userService = new User()
const location = new Location()

export {
  authentication,
  userService,
  location
}
