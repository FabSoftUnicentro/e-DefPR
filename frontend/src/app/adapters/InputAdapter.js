import React from 'react'
import Input from 'antd/lib/input'
import FormItem from 'antd/lib/form/FormItem'

const InputAdapter = ({ input: { onChange, value }, label, ...rest }) => (
  <FormItem label={label} style={{margin:0, padding: 0}}>
    <Input
      label={label}
      onChange={onChange}
      value={value}
      {...rest}
    />
  </FormItem>
)

export default InputAdapter
