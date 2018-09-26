import React, { Component } from 'react'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import { Link } from 'react-router-dom'
import message from 'antd/lib/message'
import InputAdapter from '../../adapters/InputAdapter'
import { authentication, recoveryPasswordService } from '../../services'
import { Redirect } from 'react-router-dom'
import Form from '../../components/form/Form'
import * as yup from 'yup'

import './Signin.css'

const validateSchema = yup.object().shape({
  email: yup.string().min(3, 'O email deve ter pelo menos 3 caracteres').required('Informe seu email'),
  cpf: yup.string().min(10, 'O CPF deve ter 11 caracteres').max(11, 'O CPF deve ter 11 caracteres').required('Informe seu CPF')
})

class RecoveryPassword extends Component {
  constructor (props) {
    super(props)

    this.state = {
      redirect: false,
      isLoading: false
    }

    this.onSubmit = this.onSubmit.bind(this)
  }

  async onSubmit (values) {
    const { email, cpf } = values
    this.setState({ isLoading: true })  

    try {
      const result = await recoveryPasswordService.recovery(email, cpf)
      if (result.status === 200) {
        message.success('Um email com uma nova senha foi enviado com sucesso')
        return <Redirect to='/' />
      } else if (result.status === 404) {
        message.error('Email ou CPF incorreto')
        return { cpf: 'Verifique se o CPF está correto', email: 'Verifique se o email está correto' }
      }

      return message.error('Ocorreu algum erro. Tente novamente')
    } catch (error) {
      return message.error('Ocorreu algum erro. Tente novamente')
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
          <span>Recuperar Senha</span>
        </h1>
        <div>
          <Form
            onSubmit={this.onSubmit}
            validateSchema={validateSchema}
          >
            <Form.TextField
              size='large'
              label='E-mail'
              name='email'
              placeholder='Informe seu e-mail'
              component={InputAdapter}
              prefix={<Icon type='user' />}
            />

            <Form.TextField
              size='large'
              label='CPF'
              type='text'
              name='cpf'
              placeholder='Informe seu CPF'
              component={InputAdapter}
              prefix={<Icon type='idcard' />}
            />

            <Button
              size='large'
              type='primary'
              htmlType='submit'
              style={{margin: '24px 0', width: '100%'}}
              disabled={isLoading}
              loading={isLoading}
            >
              Recuperar Senha
            </Button>
          </Form>

          <div style={{textAlign: 'center'}}>
            <Link to='/signin' >Voltar para a tela de login</Link>
          </div>

          <footer>
            <a href=''>Ajuda</a>
            <a href=''>Wikidocs</a>
            <a href='https://github.com/C3DSU/e-DefPR' target='_new'>Github</a>
            <a href='https://www3.unicentro.br/' target='_new'>Unicentro</a>
          </footer>

        </div>
      </div>
    </div>
  }
}

export default RecoveryPassword
