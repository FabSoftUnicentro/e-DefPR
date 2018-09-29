import React from 'react'
import Input from 'antd/lib/input'
import FormItem from 'antd/lib/form/FormItem'
import inputValidateProps from './inputValidateProps'

const InputAdapter = ({ input: { onChange, value }, required, label, meta, ...rest }) => {
  return <FormItem
    label={label}
    {...inputValidateProps(meta, required)}
    hasFeedback
    required={required}
  >
    <Input
      label={label}
      onChange={onChange}
      {...rest}
    />
  </FormItem>
}

export default InputAdapter
