import { observable, action, reaction } from 'mobx'

class CommonStore {
  @observable appName = 'e-DefPR'
  @observable token = window.localStorage.getItem('jwt')
  @observable appLoaded = false

  constructor () {
    reaction (
      () => this.token,
      token => {
        if (token) {
          return window.localStorage.setItem('jwt', token)
        }

        return window.localStorage.removeItem('jwt')
      }
    )
  }

  @action setAppLoaded () {
    this.appLoaded = true
  }
}

export default new CommonStore()
