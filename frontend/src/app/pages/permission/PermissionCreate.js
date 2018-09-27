import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'
import message from 'antd/lib/message'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import { permissionService } from '../../services'
import * as yup from 'yup'
import { Redirect } from 'react-router-dom'

const validateSchema = yup.object().shape({
  name: yup.string().min(3, 'O nome do nível de acesso deve ter pelo menos 3 caracteres')
  .max(191, 'O nome do nível de acesso é muito grande!')
  .matches(/^(([a-zA-Z ]|[\u00C0-\u017F])*)$/, 'Informe um nível de acesso válido')
  .required('Informe o nome do nível de acesso')
})

class PermissionCreate extends Component {
  constructor (props) {
    super(props)
    this.onSubmit = this.onSubmit.bind(this)

    this.state = {
      redirect: false
    }
  }

  async onSubmit (values) {
    const removeCreatingMessage = message.loading('Cadastrando nível de acesso', 0)

    try {
      const result = await permissionService.create(values)

      if (result.status === 201) {
        message.success('Nível de acesso cadastrado com sucesso!')

        this.setState({
          redirect: true
        })
      } else if (result.status === 403) {
        message.error('Preencha corretamente o nome!')
      } else {
        return message.error('Não foi possível cadastrar o nível de acesso!', 2)
      }
    } catch (error) {
      return message.error('Erro inesperado, tente novamente!', 2)
    } finally {
      removeCreatingMessage()
    }
  }

  attachMessage (type, message) {
    this.setState({ alertProps: { type, message } })
  }

  render () {
    if (this.state.redirect === true) {
      return <Redirect to='/permission' />
    }

    return <Page>
      <Page.Header />

      <Page.Context>
        <h2>Cadastrar Permissão</h2>
        <div className='app-page-box'>
          <Form
            onSubmit={this.onSubmit}
            validateSchema={validateSchema}
            >
            <Form.Step title='Informações da permissão'>
              <Form.TextField
                label='Nome'
                name='name'
                placeholder='Nome completo da permissão'
                required
              />
            </Form.Step>
            <Button size='large'type='primary'htmlType='submit'>Salvar <Icon type='check' /></Button>
          </Form>
        </div>
      </Page.Context>
    </Page>
  }
}

export default PermissionCreate
