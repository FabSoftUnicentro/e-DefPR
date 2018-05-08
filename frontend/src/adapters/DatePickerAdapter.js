import React from 'react'
import { DatePicker } from 'office-ui-fabric-react'

const DatePickerAdapter = ({ input, label, meta, ...rest }) => (
  <DatePicker label={label} {...rest} />
)

export default DatePickerAdapter
