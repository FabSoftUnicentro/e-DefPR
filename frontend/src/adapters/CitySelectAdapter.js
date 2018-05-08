import React from 'react'
import CitySelect from '../components/CitySelect'

const CitySelectAdapter = ({ input, label, options, ...rest }) => (
  <CitySelect
    label={label}
    {...rest}
    onChange={value => input.onChange(value)}
  />
)

export default CitySelectAdapter
