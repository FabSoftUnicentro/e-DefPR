import Authentication from './Authentication'
import User from './User'
import Assisted from './Assisted'
import Location from './Location'

const authentication = new Authentication()
const userService = new User()
const assistedService = new Assisted()
const location = new Location()

export {
  authentication,
  userService,
  assistedService,
  location
}
