import Authentication from './Authentication'
import User from './User'
import Assisted from './Assisted'
import Role from './Role'
import Location from './Location'

const authentication = new Authentication()
const userService = new User()
const assistedService = new Assisted()
const roleService = new Role()
const location = new Location()

export {
  authentication,
  userService,
  assistedService,
  roleService,
  location
}
