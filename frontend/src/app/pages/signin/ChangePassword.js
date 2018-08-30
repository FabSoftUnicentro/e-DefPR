import React, { Component } from 'react'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import message from 'antd/lib/message'
import InputAdapter from '../../adapters/InputAdapter'
import { authentication, userService } from '../../services'
import RecoveryPassword from '../../services/RecoveryPasswordService'
import { Redirect } from 'react-router-dom'
import Form from '../../components/form/Form'
import * as yup from 'yup'

import './Signin.css'

const validateSchema = yup.object().shape({
  password: yup.string().required('Digite uma nova senha').min(3, "A senha deve ter pelo menos 3 caracteres"),
  confirmPassword: yup.string().oneOf([yup.ref('password'), null], "As senhas não são iguais").required('Digite novamente a senha')
})

class Signin extends Component {
  constructor (props) {
    super(props)

    this.state = {
      redirect: false,
      isLoading: false
    }

    this.onSubmit = this.onSubmit.bind(this)
  }

  async onSubmit (values) {
    const { password, confirmPassword } = values
    this.setState({ isLoading: true })

    try {
      const result = await RecoveryPassword.change(password, confirmPassword, userService.me())
      if (result.status === 200) {
        console.log('ok')
      } else {
        console.log('nop')
      }

      return message.error('Ocorreu algum erro. Tente novamente')
    } catch (error) {
      console.log(error)
    } finally {
      this.setState({ isLoading: false })
    }
  }

  render () {
    if (authentication.isAuthenticated) {
      return <Redirect to='/' />
    }

    const { isLoading } = this.state

    return <div className='app-signin'>
      <div className='app-signin-form'>
        <h1>
          <Icon type='lock' style={{marginRight: 16}} />
          <span>Alterar Senha</span>
        </h1>
        <div>
          <Form
            onSubmit={this.onSubmit}
            validateSchema={validateSchema}
          >
            <Form.TextField
              size='large'
              label='Nova senha'
              name='password'
              type='password'
              placeholder='Senha'
              component={InputAdapter}
              prefix={<Icon type='lock' />}
            />

            <Form.TextField
              size='large'
              label='Confirme a nova senha'
              type='password'
              name='confirmPassword'
              placeholder='Confirmação de senha'
              component={InputAdapter}
              prefix={<Icon type="lock" />}
            />

            <Button
              size='large'
              type='primary'
              htmlType='submit'
              style={{margin: '24px 0', width: '100%'}}
              disabled={isLoading}
              loading={isLoading}
            >
              Alterar senha
            </Button>
          </Form>        
        </div>
      </div>
    </div>
  }
}

export default Signin
