import React, { Component } from 'react'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import { Form, Field } from 'react-final-form'
import Alert from 'antd/lib/alert'
import InputAdapter from '../../adapters/InputAdapter'
import { authentication } from '../../services'
import { Redirect } from 'react-router-dom'

import './Signin.css'

class Signin extends Component {
  constructor (props) {
    super(props)

    this.state = {
      alertProps: undefined
    }

    this.onSubmit = this.onSubmit.bind(this)
  }

  async onSubmit (values) {
    const { login, password } = values

    try {
      const result = await authentication.signin(login, password)
      if (result.statusCode === 'SUCCESS') {
        return
      }
      else if (result.status === 400) {
        return this.setState({
          alertProps: {
            type: 'error',
            message: 'CPF ou senha inválidos',
            showIcon: true
          }
        })
      }
      
      this.setState({
        alertProps: {
          type: 'warning',
          message: 'Campos CPF e senha são obrigatórios',
          showIcon: true
        }
      })
    }
    catch (error) {
      console.log(error)
    }
  }
  
  render () {
    if (authentication.isAuthenticated) {
      return <Redirect to="/" />
    }

    const { alertProps } = this.state

    return <div className="app-signin">
      <div className="app-signin-header">
        <h1>Login e-DefPR</h1>
      </div>
      <div className="app-signin-box">
        <div className="app-signin-form">
          { alertProps && <Alert {...alertProps} /> }
          <Form
            onSubmit={this.onSubmit}
            render={({ handleSubmit, pristine, invalid, submitting }) => (
              <form onSubmit={handleSubmit}>
                <Field
                  label="Usuário"
                  name="login"
                  placeholder="Informe seu CPF ou e-mail"
                  component={InputAdapter}
                  prefix={ <Icon type="user" /> }
                />

                <Field
                  label="Senha"
                  type="password"
                  name="password"
                  placeholder="Informe sua senha"
                  component={InputAdapter}
                  prefix={ <Icon type="lock" /> }
                />

                <Button
                  type="primary"
                  htmlType="submit"
                  style={{margin:'24px 0', width:'100%'}}
                  disabled={submitting}
                >
                  Login
                </Button>
              </form>
            )}
          />
          <div style={{textAlign:'center'}}>
            <a href="">Esqueceu sua senha?</a>
          </div>
        </div>

        <footer>
          <a href="">Ajuda</a>
          <a href="">Wikidocs</a>
          <a href="https://github.com/C3DSU/e-DefPR" target="_new">Github</a>
          <a href="https://www3.unicentro.br/" target="_new">Unicentro</a>
        </footer>
      </div>
    </div>
  }
}

export default Signin
