import React from 'react'
import { Label } from 'office-ui-fabric-react'
import VirtualizedSelect from 'react-virtualized-select'

const VirtualizedSelectAdapter = ({ input, label, options, ...rest }) => (
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

export default VirtualizedSelectAdapter
