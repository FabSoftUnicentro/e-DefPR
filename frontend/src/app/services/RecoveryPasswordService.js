import Service from './Service'

class RecoveryPasswordService extends Service {
  async recovery (email, cpf) {
    const result = await this.post('/user/forgot-password', { email, cpf })

    return result
  }

  async change (password) {
    const result = await this.put('/user/reset-password', { password })

    return result
  }
}

export default RecoveryPasswordService
