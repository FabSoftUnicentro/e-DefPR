import React, { Component } from 'react'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'
import message from 'antd/lib/message'
import Icon from 'antd/lib/icon'
import Button from 'antd/lib/button'
import { attendmentTypeService } from '../../services'
import * as yup from 'yup'
import { Redirect } from 'react-router-dom'

const validateSchema = yup.object().shape({
  name: yup.string().min(3, 'O tipo de atendimento deve conter pelo menos 3 caracteres')
    .max(191, 'O título do tipo de atendimento é muito grande!')
    .matches(/^(([a-zA-Z ]|[\u00C0-\u017F])*)$/, 'Informe um tipo de atendimento válido')
    .required('Informe o título do tipo de atendimento')
})

class AttendmentTypeCreate extends Component {
  constructor (props) {
    super(props)
    this.onSubmit = this.onSubmit.bind(this)

    this.state = {
      redirect: false
    }
  }

  async onSubmit (values) {
    const removeCreatingMessage = message.loading('Cadastrando tipo de atendimento', 0)

    try {
      const result = await attendmentTypeService.create(values)

      if (result.status === 201) {
        message.success('Tipo de atendimento cadastrado com sucesso!')

        this.setState({
          redirect: true
        })
      } else if (result.status === 403) {
        message.error('Preencha corretamente o título!')
      } else {
        return message.error('Não foi possível cadastrar o tipo de atendimento!', 2)
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
      return <Redirect to='/attendmentType' />
    }

    return <Page>
      <Page.Header />

      <Page.Context>
        <h2>Cadastrar Tipo de Atendimento</h2>
        <div className='app-page-box'>
          <Form
            onSubmit={this.onSubmit}
            validateSchema={validateSchema}
          >
            <Form.TextField
              label='Nome'
              name='name'
              placeholder='Título completo do tipo de atendimento'
              required
            />
            <Form.TextField
              label='Descrição'
              name='description'
              placeholder='Descrição do tipo de atendimento'
              required
            />
            <Button size='large'type='primary'htmlType='submit'>Salvar <Icon type='check' /></Button>
          </Form>
        </div>
      </Page.Context>
    </Page>
  }
}

export default AttendmentTypeCreate
