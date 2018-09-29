import React from 'react'
import Select from 'antd/lib/select'
import FormItem from 'antd/lib/form/FormItem'
import inputValidateProps from './inputValidateProps'

const SelectAdapter = ({ input: { onChange, value }, options, children, label, meta, required, ...rest }) => (
  <FormItem 
    label={label} 
    {...inputValidateProps(meta, required)}
    hasFeedback
    required={required}
  >
    <Select
      label={label}
      onChange={onChange}
      value={value}
      {...rest}
    >
      { children && children }
      { !children && options && options.map(item => (
        <Select.Option key={item.value} value={item.value}>{ item.name }</Select.Option>
      )) }
    </Select>
  </FormItem>
)

export default SelectAdapter
