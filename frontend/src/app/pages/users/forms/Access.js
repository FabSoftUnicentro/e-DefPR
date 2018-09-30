import React, { Fragment } from 'react'
import * as yup from 'yup'
import WizardForm from '../../../components/form/WizardForm'

const accessValidator = yup.object().shape({
  password_confirmation: yup.string()
    .oneOf([yup.ref('password'), null], 'A confirmação deve ser igual a senha')
    .required('Confirme a senha'),
  password: yup.string().required('Informe uma senha'),
  email: yup.string().email('Informe um email válido').required('Informe o e-mail do funcionário')
})

const AccessForm = () => (<Fragment>
  <WizardForm.TextField
    label='E-mail'
    name='email'
    required
  />

  <WizardForm.TextField
    label='Repita a senha'
    name='password'
    type='password'
    required
  />

  <WizardForm.TextField
    label='Repita a senha'
    name='password_confirmation'
    type='password'
    required
  />
</Fragment>)

export {
  accessValidator,
  AccessForm
}
