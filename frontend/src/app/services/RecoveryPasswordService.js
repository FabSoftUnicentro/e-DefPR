import Service from './Service'

class RecoveryPasswordService extends Service {
  async recovery (email, cpf) {
    const result = await this.post('/user/forgot-password', { email, cpf })

    return result
  }

  async change (password, confirmPassword, id) {
    console.log(id)
    //const result = await this.post('/user/'id, { password, confirmPassword })

    //return result
  }
}

export default RecoveryPasswordService
