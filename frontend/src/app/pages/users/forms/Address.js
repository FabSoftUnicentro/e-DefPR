import React, { Fragment } from 'react'
import WizardForm from '../../../components/form/WizardForm'
import * as yup from 'yup'

const addressValidator = yup.object().shape({
})

const AddressForm = () => (<Fragment>
  <WizardForm.TextField
    label='CEP'
    name='cep'
  />

  <WizardForm.Inline>
    <WizardForm.TextField
      label='Rua'
      name='rua'
    />

    <WizardForm.TextField
      label='Número'
      name='number'
    />
  </WizardForm.Inline>

  <WizardForm.CitySelect
    label='Estado e cidade'
    name='city'
  />

  <WizardForm.Inline>
    <WizardForm.TextField
      label='Bairro'
      name='rua'
    />

    <WizardForm.TextField
      label='Complemento'
      name='number'
    />
  </WizardForm.Inline>
</Fragment>)

export {
  addressValidator,
  AddressForm
}
