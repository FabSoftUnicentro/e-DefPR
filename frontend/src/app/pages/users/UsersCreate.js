import React, { Component } from 'react'
import * as yup from 'yup'
import Page from '../../components/page/Page'
import WizardForm from '../../components/form/WizardForm'

const validateSchema = [
  yup.object().shape({
    name: yup.string().trim().min(3).required('Informe o nome do funcionário')
  })
]
class UsersCreate extends Component {
  constructor (props) {
    super(props)

    this.onSubmit = this.onSubmit.bind(this)
  }

  onSubmit (values) {
    console.log(values)
  }

  render () {
    return <Page>
      <Page.Header
        title='TEste'
      />

      <Page.Context>
        <h2>Cadastrar novo funcionário</h2>

        <WizardForm
          onSubmit={this.onSubmit}
          validateSchema={validateSchema}
        >
          <WizardForm.Page
            icon='idcard'
            title='Informações pessoais'
          >
            <WizardForm.TextField
              label='Nome completo'
              name='name'
              required
            />

            <WizardForm.TextField
              label='CPF'
              name='cpf'
            />

            <WizardForm.DatePicker
              label='Data de nascimento'
              name='birthday'
            />
          </WizardForm.Page>

          <WizardForm.Page
            icon='mail'
            title='Endereço'
          >
            <WizardForm.TextField
              label='Rua'
              name='rua'
            />
          </WizardForm.Page>

          <WizardForm.Page
            icon='lock'
            title='Acesso'
          >
            <WizardForm.TextField
              label='Nome completo'
              name='name'
            />
          </WizardForm.Page>
        </WizardForm>
      </Page.Context>
    </Page>
  }
}

export default UsersCreate
