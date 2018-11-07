import { observable, action } from 'mobx'
import { Auth } from 'app/services'

class UserStore {
  @observable currentUser
  @observable loadingUser

  @action pullUser () {
    this.loadingUser = true
    const user = await Auth.current()
    action(() => { this.currentUser = user })
    action(() => { this.loadingUser = false })
  }
}

export default new UserStore()
