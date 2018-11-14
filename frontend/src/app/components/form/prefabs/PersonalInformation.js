import React, { Fragment } from 'react'
import * as yup from 'yup'
import WizardForm from '../WizardForm'

const personalInformationValidator = yup.object().shape({
  marital_status: yup.string().required('Informe o estado civil do funcionário'),
  rg_issuer: yup.string().min(2, 'O orgão emissor deve ter pelo menos 2 caracteres').matches(/^(([a-zA-Z ]|[\u00C0-\u017F])*)$/, 'Informe um orgão emissor válido').required('Informe o orgão emissor'),
  rg: yup.string().min(2, 'O RG deve ter pelo menos 2 caracteres').max(20, 'Informe um RG válido').required('Informe o RG do funcionáiro'),
  birth_date: yup.string().required('Informe a data de nascimento do funcionário'),
  cpf: yup.string().required('Informe o cpf do funcionário').matches(/([0-9]{3}[.]?[0-9]{3}[.]?[0-9]{3}[-]?[0-9]{2})/, 'Informe um CPF válido'),
  name: yup.string().min(3, 'O nome do funcionário deve ter pelo menos 3 caracteres').required('Informe o nome do funcionário')
})

const PersonalInformationForm = () => (<Fragment>
  <WizardForm.TextField
    label='Nome completo'
    name='name'
    required
  />

  <WizardForm.Inline>
    <WizardForm.TextField
      label='CPF'
      name='cpf'
      required
    />

    <WizardForm.DatePicker
      label='Data de nascimento'
      name='birth_date'
      required
    />
  </WizardForm.Inline>

  <WizardForm.Inline>
    <WizardForm.TextField
      label='RG'
      name='rg'
      required
    />

    <WizardForm.TextField
      label='Orgão emissor'
      name='rg_issuer'
      required
    />
  </WizardForm.Inline>

  <WizardForm.Radio
    label='Gênero'
    name='gender'
    asButtons
    options={[
      { label: 'Masculino', value: 'M' },
      { label: 'Feminino', value: 'F' },
      { label: 'Outro', value: 'O', disabled: true }
    ]}
  />

  <WizardForm.CitySelect
    label='Estado e cidade natal'
    name='birthplace'
    required
  />

  <WizardForm.Select label='Estado civil' name='marital_status' style={{ width: 335 }} required options={[
    { value: 'solteiro', name: 'Solteiro(a)' },
    { value: 'casado', name: 'Casado(a)' },
    { value: 'separado/divorciado', name: 'Separado(a)/Divorciado(a)' },
    { value: 'viuvo', name: 'Viúvo(a)' },
    { value: 'uniao-estavel', name: 'União Estável' },
    { value: 'outro', name: 'Outro' }
  ]} />

  <WizardForm.TextField
    label='Anotações'
    name='note'
  />
</Fragment>)

export {
  personalInformationValidator,
  PersonalInformationForm
}
