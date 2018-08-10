import React, { Component } from 'react'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import { Form, Field } from 'react-final-form'
import Alert from 'antd/lib/alert'
import message from 'antd/lib/message'
import InputAdapter from '../../adapters/InputAdapter'
import { authentication, userService } from '../../services'
import { Redirect } from 'react-router-dom'

import './Signin.css'

class Signin extends Component {
  constructor (props) {
    super(props)

    this.state = {
      redirect: false,
      alertProps: undefined
    }

    this.onSubmit = this.onSubmit.bind(this)
  }

  async onSubmit (values) {
    const { login, password } = values

    try {
      const result = await authentication.signin(login, password)
      if (result.statusCode === 'SUCCESS') {
        this.attachMessage('success', 'Login realizado com sucesso')

        const account = await userService.account()
        if (account.data) {
          message.success(`Bem-vindo, ${account.data.name}!`, 2)
          this.setState({ redirect: true })
        }
      } else if (result.status === 400) {
        return this.attachMessage('error', 'Usuário ou senha inválido.')
      }

      return this.attachMessage('warning', 'Campos usuário e senha são obrigatórios')
    } catch (error) {
      console.log(error)
    }
  }

  attachMessage (type, message) {
    this.setState({ alertProps: { type, message } })
  }

  render () {
    if (authentication.isAuthenticated) {
      return <Redirect to='/' />
    }

    const { alertProps } = this.state

    return <div className='app-signin'>
      <div className='app-signin-form'>
        <h1>
          <Icon type='lock' style={{marginRight: 16}} />
          <span>Login e-DefPR</span>
        </h1>
        <div>
          { alertProps && <Alert {...alertProps} showIcon /> }
          <Form
            onSubmit={this.onSubmit}
            render={({ handleSubmit, pristine, invalid, submitting }) => (
              <form onSubmit={handleSubmit}>
                <Field
                  size='large'
                  label='Usuário'
                  name='login'
                  placeholder='Informe seu CPF ou e-mail'
                  component={InputAdapter}
                  prefix={<Icon type='user' />}
                />

                <Field
                  size='large'
                  label='Senha'
                  type='password'
                  name='password'
                  placeholder='Informe sua senha'
                  component={InputAdapter}
                  prefix={<Icon type='lock' />}
                />

                <Button
                  size='large'
                  type='primary'
                  htmlType='submit'
                  style={{margin: '24px 0', width: '100%'}}
                  disabled={submitting}
                >
                  Login
                </Button>
              </form>
            )}
          />
          <div style={{textAlign: 'center'}}>
            <a href=''>Esqueceu sua senha?</a>
          </div>
        </div>

        <footer>
          <a href=''>Ajuda</a>
          <a href=''>Wikidocs</a>
          <a href='https://github.com/C3DSU/e-DefPR' target='_new'>Github</a>
          <a href='https://www3.unicentro.br/' target='_new'>Unicentro</a>
        </footer>
      </div>
    </div>
  }
}

export default Signin
