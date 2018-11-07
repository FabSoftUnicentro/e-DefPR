import { observable, action } from 'mobx'
import { Auth } from 'app/services'

class AuthStore {
  @observable inProgress = false
  @observable errors = undefined

  @observable values = {
    login: '',
    password: ''
  }

  @action async login () {
    this.inProgress = true
    this.errors = undefined

    const { login, password } = this.values
    try {
      const result = await Auth.login(login, password)
      
    } catch (error) {
      console.log(error)
      this.errors = error
    }
  }
}
