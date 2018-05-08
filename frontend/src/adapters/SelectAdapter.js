import React from 'react'
import { Label } from 'office-ui-fabric-react'
import BasicSelect from '../components/BasicSelect'

const SelectAdapter = ({ input, label, options, ...rest }) => (
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

export default SelectAdapter
