import Authentication from './Authentication'
import User from './User'
import Assisted from './Assisted'
import Role from './Role'
import Permission from './Permission'
import Location from './Location'

const authentication = new Authentication()
const userService = new User()
const assistedService = new Assisted()
const roleService = new Role()
const permissionService = new Permission()
const location = new Location()

export {
  authentication,
  userService,
  assistedService,
  roleService,
  permissionService,
  location
}
