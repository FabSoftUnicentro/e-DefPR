import React from 'react'
import { TextField, Label, DatePicker } from 'office-ui-fabric-react'
import VirtualizedSelect from 'react-virtualized-select'
import { Field } from 'react-final-form'
import BasicSelect from './BasicSelect'
import CitySelect from './CitySelect'

export const TextFieldAdapter = ({ input, label, meta, ...rest }) => (
  <TextField
    label={label}
    {...rest}
    onChanged={value => input.onChange(value)}
  />
)

export const DatePickerAdapter = ({ input, label, meta, ...rest }) => (
  <DatePicker label={label} {...rest} />
)

export const SelectAdapter = ({ input, label, options, ...rest }) => (
  <div className='md-TextField-wrapper'>
    <Label>{label}</Label>
    <BasicSelect
      {...rest}
      placeholder='Selecione...'
      noResultsText='Nenhum resultado encontrado.'
      options={options}
    />
  </div>
)

export const GenderSelect = ({ input, name, label, ...rest }) => (
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

export const CivilStateSelect = ({ input, name, label, ...rest }) => (
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

export const VirtualizedSelectAdapter = ({ input, label, options, ...rest }) => (
  <div className='ms-TextField-wrapper'>
    <Label>{label}</Label>
    <VirtualizedSelect
      {...rest}
      placeholder='Selecione...'
      noResultsText='Nenhum resultado encontrado.'
      options={options}
    />
  </div>
)

export const CitySelectAdapter = ({ input, label, options, ...rest }) => (
  <CitySelect
    label={label}
    {...rest}
    onChange={value => input.onChange(value)}
  />
)
