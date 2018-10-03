import React, { Component } from 'react'
import message from 'antd/lib/message'
import Button from 'antd/lib/button'
import { Link } from 'react-router-dom'
import * as yup from 'yup'
import Page from '../../components/page/Page'
import Form from '../../components/form/Form'
import { roleService } from '../../services'

const validateSchema = yup.object().shape({
  name: yup.string().min(3, 'O nome do nível de acesso deve ter pelo menos 3 caracteres')
    .max(191, 'O nome do nível de acesso é muito grande!')
    .matches(/^(([a-zA-Z ]|[\u00C0-\u017F])*)$/, 'Informe um nível de acesso válido')
    .required('Informe o nome do nível de acesso')
})

class RoleCreate extends Component {
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
      const result = await roleService.create(values)

      if (result.status === 201) {
        await message.success('Nível de acesso cadastrado com sucesso!')
        this.props.history.push('/role')
      } else if (result.status === 422) {
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

  render () {
    return <Page>
      <Page.Header>
        <Link to='/role'><Button type='danger'>Cancelar</Button></Link>
      </Page.Header>

      <Page.Context>
        <h2>Cadastrar nível de acesso</h2>
        <div className='app-page-box'>
          <Form
            onSubmit={this.onSubmit}
            validateSchema={validateSchema}
          >
            <Form.TextField
              label='Nome'
              name='name'
              placeholder='Nome completo do nível de acesso'
              required
            />
            <Button size='large' type='primary' htmlType='submit' icon='check'>Salvar</Button>
          </Form>
        </div>
      </Page.Context>
    </Page>
  }
}

export default RoleCreate
