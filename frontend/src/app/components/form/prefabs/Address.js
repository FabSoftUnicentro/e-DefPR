import React, { Fragment } from 'react'
import * as yup from 'yup'
import WizardForm from '../WizardForm'

const addressValidator = yup.object().shape({
  address: yup.object().shape({
    neighbourhood: yup.string().min(2, 'O bairro deve ter pelo menos 2 caracteres').max(100, 'Informe um bairro válido').required('Informe o bairro do funcionário'),
    city: yup.string().required('Informe a cidade do funcionário'),
    number: yup.string().required('Informe o número residencial do funcionário'),
    cep: yup.string().min(2, 'O CEP deve ter pelo menos 2 caracteres').max(8, 'Informe um CEP válido').required('Informe o CEP do endereço do funcionário')
  })
})

const AddressForm = () => (<Fragment>
  <WizardForm.TextField
    label='CEP'
    name='address[cep]'
    required
  />

  <WizardForm.Inline>
    <WizardForm.TextField
      label='Rua'
      name='address[rua]'
      required
    />

    <WizardForm.TextField
      label='Número'
      name='address[number]'
      required
    />
  </WizardForm.Inline>

  <WizardForm.CitySelect
    label='Estado e cidade'
    name='address[city]'
    required
  />

  <WizardForm.Inline>
    <WizardForm.TextField
      label='Bairro'
      name='address[neighbourhood]'
      required
    />

    <WizardForm.TextField
      label='Complemento'
      name='address[complement]'
    />
  </WizardForm.Inline>
</Fragment>)

export {
  addressValidator,
  AddressForm
}
