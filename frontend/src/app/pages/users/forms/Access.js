import React, { Fragment } from 'react'
import WizardForm from '../../../components/form/WizardForm'
import * as yup from 'yup'

const accessValidator = yup.object().shape({
})

const AccessForm = () => (<Fragment>
  <WizardForm.TextField
    label='E-mail'
    name='name'
  />

  <WizardForm.TextField
    label='Senha'
    name='name'
  />

  <WizardForm.TextField
    label='Repita a senha'
    name='name'
  />
</Fragment>)

export {
  accessValidator,
  AccessForm
}
