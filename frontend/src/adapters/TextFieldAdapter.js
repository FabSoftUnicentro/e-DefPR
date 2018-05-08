import React from 'react'
import { TextField } from 'office-ui-fabric-react'

const TextFieldAdapter = ({ input, label, meta, ...rest }) => (
  <TextField
    label={label}
    {...rest}
    onChanged={value => input.onChange(value)}
  />
)

export default TextFieldAdapter
