import Authentication from './Authentication'
import User from './User'
import Assisted from './Assisted'
import Location from './Location'
import RecoveryPasswordService from './RecoveryPasswordService'

const authentication = new Authentication()
const userService = new User()
const assistedService = new Assisted()
const location = new Location()
const recoveryPasswordService = new RecoveryPasswordService()

export {
  authentication,
  userService,
  location,
  recoveryPasswordService,
  assistedService
}
