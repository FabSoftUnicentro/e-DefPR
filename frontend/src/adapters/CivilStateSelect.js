import React from 'react'
import { Field } from 'react-final-form'
import SelectAdapter from './SelectAdapter'

const CivilStateSelect = ({ input, name, label, ...rest }) => (
  <Field
    name={name}
    label={label}
    {...rest}
    component={SelectAdapter}
    searchable={false}
    onChange={value => input.onChange(value)}
    options={[
      { value: 'Solteiro(a)', label: 'Solteiro(a)' },
      { value: 'Casado(a)', label: 'Casado(a)' },
      { value: 'Separado(a)/divorciado(a)', label: 'Separado(a)/divorciado(a)' },
      { value: 'Viúvo(a)', label: 'Viúvo(a)' },
      { value: 'Outro', label: 'Outro' }
    ]}
  />
)

export default CivilStateSelect
