import Authentication from './Authentication'
import User from './User'
import Location from './Location'
import RecoveryPasswordService from './RecoveryPasswordService'

const authentication = new Authentication()
const userService = new User()
const location = new Location()
const recoveryPasswordService = new RecoveryPasswordService()

export {
  authentication,
  userService,
  location,
  recoveryPasswordService
}
