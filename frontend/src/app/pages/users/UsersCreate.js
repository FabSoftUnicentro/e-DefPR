import React, { Component } from 'react'
import Page from '../../components/page/Page'
import WizardForm from '../../components/form/WizardForm'
import { PersonalInformationForm, personalInformationValidator } from './forms/PersonalInformation'
import { AddressForm, addressValidator } from './forms/Address'
import { AccessForm, accessValidator } from './forms/Access'


const validateSchema = [
  personalInformationValidator,
  addressValidator,
  accessValidator
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
          <WizardForm.Page icon='idcard' title='Informações pessoais'>
            <PersonalInformationForm />
          </WizardForm.Page>

          <WizardForm.Page icon='mail' title='Endereço'>
            <AddressForm />
          </WizardForm.Page>

          <WizardForm.Page icon='lock' title='Acesso'>
            <AccessForm />
          </WizardForm.Page>
        </WizardForm>
      </Page.Context>
    </Page>
  }
}

export default UsersCreate
