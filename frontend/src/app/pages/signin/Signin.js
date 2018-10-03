import React, { Component } from 'react'
import Icon from 'antd/lib/icon'
import { Link, Redirect } from 'react-router-dom'
import Button from 'antd/lib/button'
import message from 'antd/lib/message'
import InputAdapter from '../../adapters/InputAdapter'
import { authentication, userService } from '../../services'
import * as yup from 'yup'
import Form from '../../components/form/Form'

import './Signin.css'

const validateSchema = yup.object().shape({
  password: yup.string().min(3, 'A senha deve ter pelo menos 3 caracteres').required('Informe sua senha'),
  login: yup.string().min(3, 'O usuário deve ter pelo menos 3 caracteres').required('Informe seu usuário')
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
    const { login, password } = values
    this.setState({ isLoading: true })

    try {
      const result = await authentication.signin(login, password)
      if (result.status === 200) {
        const account = await userService.me()
        if (account) {
          message.success(`Bem-vindo de volta, ${account.name}!`, 2)
        }

        return
      } else if (result.status === 404) {
        return { login: 'Este usuário não existe' }
      } else if (result.status === 401) {
        return { password: 'Esta senha não está correta' }
      }

      return message.error('Não foi possível realizar login. Tente novamente')
    } catch (error) {
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
          <Icon type='lock' style={{ marginRight: 16 }} />
          <span>Login e-DefPR</span>
        </h1>
        <div>
          <Form
            onSubmit={this.onSubmit}
            validateSchema={validateSchema}
          >
            <Form.TextField
              size='large'
              label='Usuário'
              name='login'
              required
              placeholder='Informe seu CPF ou e-mail'
              component={InputAdapter}
              prefix={<Icon type='user' />}
            />

            <Form.TextField
              size='large'
              label='Senha'
              type='password'
              required
              name='password'
              placeholder='Informe sua senha'
              component={InputAdapter}
              prefix={<Icon type='lock' />}
            />

            <Button
              size='large'
              type='primary'
              htmlType='submit'
              style={{ marginTop: 4, marginBottom: 24, width: '100%' }}
              disabled={isLoading}
              loading={isLoading}
            >
              Login
            </Button>
          </Form>

          <div style={{ textAlign: 'center' }}>
            <Link to='/signin/recovery-password' >Esqueceu sua senha?</Link>
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
