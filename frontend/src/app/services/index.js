import Authentication from './Authentication'
import User from './User'
import Assisted from './Assisted'
import Role from './Role'
import Permission from './Permission'
import AttendmentType from './AttendmentType'
import Location from './Location'
import RecoveryPasswordService from './RecoveryPasswordService'

const authentication = new Authentication()
const userService = new User()
const recoveryPasswordService = new RecoveryPasswordService()
const assistedService = new Assisted()
const roleService = new Role()
const permissionService = new Permission()
const attendmentTypeService = new AttendmentType()
const location = new Location()

export {
  authentication,
  userService,
  recoveryPasswordService,
  assistedService,
  roleService,
  permissionService,
  attendmentTypeService,
  location
}
