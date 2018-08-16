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
      alertProps: undefined,
      isLoading: false
    }

    this.onSubmit = this.onSubmit.bind(this)
  }

  async onSubmit (values) {
    const { login, password } = values
    this.setState({ isLoading: true })

    try {
      const result = await authentication.signin(login, password)
      if (result.status === 200) {
        this.attachMessage('success', 'Login realizado com sucesso')

        const account = await userService.me()
        if (account.data) {
          message.success(`Bem-vindo, ${account.data.name}!`, 2)
        }
      } else if (result.status === 401) {
        return this.attachMessage('error', 'Senha inválida')
      } else if (result.status === 404) {
        return this.attachMessage('error', 'Usuário e senha inválida')
      }

      return this.attachMessage('error', 'Não foi possível realizar login. Tente novamente')
    } catch (error) {
      console.log(error)
    }
    finally {
      this.setState({ isLoading: false })
    }
  }

  attachMessage (type, message) {
    this.setState({ alertProps: { type, message } })
  }

  render () {
    if (authentication.isAuthenticated) {
      return <Redirect to='/' />
    }

    const { alertProps, isLoading } = this.state

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
                  loading={isLoading}
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
