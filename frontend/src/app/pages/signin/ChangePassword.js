import React, { Component } from 'react'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import message from 'antd/lib/message'
import InputAdapter from '../../adapters/InputAdapter'
import { authentication, userService, recoveryPasswordService } from '../../services'
import Form from '../../components/form/Form'
import * as yup from 'yup'
import { Redirect } from 'react-router-dom'

import './Signin.css'

const validateSchema = yup.object().shape({
  password: yup.string().min(3, 'A senha deve ter pelo menos 3 caracteres').required('Digite uma nova senha'),
  confirmPassword: yup.string().oneOf([yup.ref('password'), null], 'As senhas não são iguais').required('Digite novamente a senha')
})

class ChangePassword extends Component {
  constructor (props) {
    super(props)

    this.state = {
      redirect: false,
      isLoading: false
    }

    this.onSubmit = this.onSubmit.bind(this)
  }

  async onSubmit (values) {
    const { password } = values
    this.setState({ isLoading: true })

    try {
      const result = await recoveryPasswordService.change(password)
      if (result.status === 200) {
        message.success('Senha alterada com sucesso')
        await userService.me()
        return <Redirect to='/' />
      } else {
        return message.error('Ocorreu algum erro. Tente novamente')
      }
    } catch (error) {
      return message.error('Ocorreu algum erro. Tente novamente')
    } finally {
      this.setState({ isLoading: false })
    }
  }

  render () {
    const { isLoading } = this.state

    if (!authentication.isAuthenticated) {
      return <Redirect to='/' />
    }

    if (authentication.account.must_change_password === 0) {
      return <Redirect to='/' />
    }

    return <div className='app-signin'>
      <div className='app-signin-form'>
        <h1>
          <Icon type='lock' style={{marginRight: 16}} />
          <span>Alterar Senha</span>
        </h1>
        Você está usando uma senha temporaria, por favor, altere sua senha antes de poder acessar o sistema
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
              prefix={<Icon type='lock' />}
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

export default ChangePassword
