import React from 'react'
import Select from 'antd/lib/select'
import FormItem from 'antd/lib/form/FormItem'

const SelectAdapter = ({ input: { onChange, value }, options, children, label, ...rest }) => (
  <FormItem label={label} style={{margin:0, padding: 0}}>
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
