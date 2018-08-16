import React from 'react'
import Input from 'antd/lib/input'
import FormItem from 'antd/lib/form/FormItem'

// TODO: refactor this
const inputValidateProps = meta => {
  const validation = {}
  if (meta.touched && meta.error) {
    validation.validateStatus = 'error'
    validation.help = meta.error
  } else if (meta.submitError) {
    validation.validateStatus = 'warning'
    validation.help = meta.submitError
  } else {
    validation.validateStatus = meta.touched ? 'success' : undefined
  }

  return validation
}

const InputAdapter = ({ input: { onChange, value }, required, label, meta, ...rest }) => {
  return <FormItem
    label={label}
    // style={{margin:0, padding: 0}}
    {...inputValidateProps(meta)}
    hasFeedback
    required={required}
  >
    <Input
      label={label}
      onChange={onChange}
      value={value}
      {...rest}
    />
  </FormItem>
}

export default InputAdapter
