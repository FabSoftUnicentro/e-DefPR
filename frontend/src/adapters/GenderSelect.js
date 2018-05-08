import React from 'react'
import { Field } from 'react-final-form'
import SelectAdapter from './SelectAdapter'

const GenderSelect = ({ input, name, label, ...rest }) => (
  <Field
    name={name}
    label={label}
    {...rest}
    component={SelectAdapter}
    searchable={false}
    onChange={value => input.onChange(value)}
    options={[
      { value: 'masculino', label: 'Masculino' },
      { value: 'feminino', label: 'Feminino' }
    ]}
  />
)

export default GenderSelect
