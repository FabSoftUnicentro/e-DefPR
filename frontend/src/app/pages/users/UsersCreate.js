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
import { AccessForm, accessValidator } from './forms/Access'
import { userService } from '../../services'

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

  async onSubmit (values) {
    values.birthplace = values.birthplace.city
    values.addresses = [ values.address ]

    const removeCreatingMessage = message.loading('Cadastrando funcioonário', 0)

    try {
      const result = await userService.create(values)

      if (result.status === 201) {
        await message.success('Funcionário cadastrado com sucesso!')
        this.props.history.push('/users')
      } else if (result.status === 422) {
        message.error('Preencha corretamente as informações!')
      }

      return message.error('Não foi possível cadastrar o funcionário!')
    } catch (error) {
      return message.error('Erro inesperado, tente novamente!')
    } finally {
      removeCreatingMessage()
    }
  }

  render () {
    return <Page>
      <Page.Header>
        <Link to='/users'><Button type='danger'>Cancelar</Button></Link>
      </Page.Header>

      <Page.Context>
        <h2>Cadastrar novo funcionário</h2>

        <WizardForm
          onSubmit={this.onSubmit}
          validateSchema={validateSchema}
        >
          <WizardForm.Page icon='idcard' title='Informações pessoais'>
            <PersonalInformationForm />
          </WizardForm.Page>

          <WizardForm.Page icon='home' title='Endereço'>
            <AddressForm />
          </WizardForm.Page>

          <WizardForm.Page icon='lock' title='Contato'>
            <AccessForm />
          </WizardForm.Page>
        </WizardForm>
      </Page.Context>
    </Page>
  }
}

export default UsersCreate
