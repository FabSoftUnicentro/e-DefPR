import React, { Component } from 'react'
import message from 'antd/lib/message'
import { Link } from 'react-router-dom'
import Button from 'antd/lib/button'
import Page from '../../components/page/Page'
import WizardForm from '../../components/form/WizardForm'
import {
  PersonalInformationForm,
  personalInformationValidator
} from '../../components/form/prefabs/PersonalInformation'
import { AddressForm, addressValidator } from '../../components/form/prefabs/Address'
import { assistedService } from '../../services'

const validateSchema = [
  personalInformationValidator,
  addressValidator
]

class AssistedCreate extends Component {
  constructor (props) {
    super(props)

    this.onSubmit = this.onSubmit.bind(this)
  }

  async onSubmit (values) {
    values.birthplace = values.birthplace.city
    values.addresses = [ values.address ]

    const removeCreatingMessage = message.loading('Cadastrando assistido', 0)

    try {
      const result = await assistedService.create(values)

      if (result.status === 201) {
        await message.success('Assistido cadastrado com sucesso!')
        this.props.history.push('/assisted')
      } else if (result.status === 422) {
        message.error('Preencha corretamente as informações!')
      } else {
        return message.error('Não foi possível cadastrar o assistido!')
      }
    } catch (error) {
      return message.error('Erro inesperado, tente novamente!')
    } finally {
      removeCreatingMessage()
    }
  }

  render () {
    return <Page>
      <Page.Header>
        <Link to='/assisted'><Button type='danger'>Cancelar</Button></Link>
      </Page.Header>

      <Page.Context>
        <h2>Cadastrar assistido</h2>
        <div className='app-page-box'>
          <WizardForm
            onSubmit={this.onSubmit}
            validateSchema={validateSchema}
          >
            <WizardForm.Page icon='idcard' title='Informações pessoais'>
              <PersonalInformationForm />
              <WizardForm.TextField
                label='Profissão'
                name='profession'
                required
              />
            </WizardForm.Page>

            <WizardForm.Page icon='home' title='Endereço'>
              <AddressForm />
            </WizardForm.Page>

            <WizardForm.Page icon='mail' title='Contato'>
              <WizardForm.TextField label='E-mail' name='email' required />
            </WizardForm.Page>
          </WizardForm>
        </div>
      </Page.Context>
    </Page>
  }
}

export default AssistedCreate
