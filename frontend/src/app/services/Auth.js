import requests from './requests'

const { unauthenticated } = requests
const CONTROLLER = 'user'

const Auth = {
  async current () {
    return unauthenticated.get(`/${CONTROLLER}/me`)
  },

  async login (login, password) {
    return unauthenticated.post(`/${CONTROLLER}/authenticate`, { login, password })
  },

  async logout () {
    return unauthenticated.get(`/${CONTROLLER}/logout`)
  },

  async recovery (email, cpf) {
    return unauthenticated.post(`/${CONTROLLER}/forgot-password`, { email, cpf })
  },

  async changePassword (password) {
    return unauthenticated.put(`/${CONTROLLER}/reset-password`, { password })
  }
}

export default Auth
